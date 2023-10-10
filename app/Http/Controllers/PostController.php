<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\Url;
use Exception;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Support\Facades\Http;


class PostController extends Controller
{
    //     /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        return view('home');
    }
    public function detail()
    {
        return view('detail');
    }
    public function history(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user->id) {

            $query = Post::query();
            
            $query_param = $request->query();
            if (!$user->isAdmin()) {
                $query->where('user_id', auth()->user()->id);
            }
            if (isset($query_param['title'])) {
                $query->where('title', 'LIKE', '%' . $query_param['title'] . '%');
            }
            if (isset($query_param['keyword'])) {
                $query->whereHas('keywords', function ($query) use ($query_param) {
                    $query->where('name', 'LIKE', '%' . $query_param['keyword'] . '%');
                });
            }

            if (isset($query_param['date_from'])) {
                $dateFrom = Carbon::parse($query_param['date_from']);
                $query->whereDate('created_at', '>=', $dateFrom);
            }

            if (isset($query_param['date_to'])) {
                $dateTo = Carbon::parse($query_param['date_to']);
                $query->whereDate('created_at', '<=', $dateTo);
            }

            $posts = $query->get()->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'keywords' => $post->keywords->map(function ($keyword) {
                        return $keyword['name'];
                    }),
                    'content' => $post->content,
                    'content_by_gpt' => $post->content_by_gpt,
                    'creater' => $post->user,
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                ];
            });

            return view('list', [
                'posts' => $posts
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content') ?? $request->input('content_by_gpt'),
                'content_by_gpt' => $request->input('content_by_gpt'),
                'user_id' => auth()->user()->id,
            ]);

            $keywords = $request->input('keywords');
            foreach ($keywords as $keyword) {
                Keyword::create([
                    'name' => $keyword,
                    'post_id' => $post->id
                ]);
            }
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('detail', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'content_by_gpt' => $post->content_by_gpt,
                'content' => $post->content,
                'keywords' => $post->keywords->map(function ($keyword) {
                    return $keyword->name;
                }),
            ]
        ]);
    }
    public function update($id, Request $request)
    {
        try {
            $post = Post::find($id);
            $post->content = $request->content;
            $post->save();
            return redirect("/posts/" . $post->id)->with("status", "Cập nhật bài viết thành công");
        } catch (\Throwable $th) {
            return redirect("/posts/" . $post->id)->with("status", "Cập nhật bài viết thất bại");
        }
    }
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/history');
    }
    public function list()
    {
        return view('list');
    }
    public function setting()
    {
        return view('setting');
    }

    public function getdataweb(Request $request)
    {
        $linkweb = Url::where('user_id', auth()->user()->id)->get()->pluck('link_website')[0];

        $html = file_get_contents($linkweb);
        $startPos = strpos($html, '<body');
        if ($startPos !== false) {
            $endPos = strpos($html, '</body>', $startPos);
            if ($endPos !== false) {
                $bodyText = substr($html, $startPos, $endPos - $startPos + 7);
                $text = $bodyText;
            } else {
                $text = "";
            }
        } else {
            $text = "";
        }
        $text = strip_tags($text);

        return $text;
    }

    public function askToChatGPT($text, $keyword)
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . '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',
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.openai.com/v1/chat/completions', [
                    "model" => "gpt-3.5-turbo",
                    "messages" => [
                        [
                            "role" => 'user',
                            "content" => 'chọn key word liên quan đến' . $keyword . 'trong đoạn:' . $text . 'theo cấu liệt kê gạch nối'
                        ]
                    ],
                    "max_tokens" => 60,
                    "temperature" => 0.5,
                ]);

            $data = json_decode($response);

            $content = $data->choices[0]->message->content;
            $keywords = [];
            if (strpos($content, ',') !== false) {

                $keywords = explode(',', $content);
            } else {

                $keywords = explode('-', $content);
            }

            array_shift($keywords);
            array_pop($keywords);

        return $keywords;
        }
        catch(Exception $e){
            echo 'An error occurred: ' . $e->getMessage();
            return [];
        }
    }



    public function create_keyword_by_gpt(Request $request)
    {
        $text = $this->getdataweb($request);
        $tokenizedText = preg_replace('/[[:punct:]]/', '', $text);
        $words = str_word_count($tokenizedText, 1);
        $maxTokenCount = 1500; 
        
        if (count($words) > $maxTokenCount) {
            $selectedWords = array_slice($words, 0, $maxTokenCount);
            $selectedText = implode(' ', $selectedWords);

            $lastWordIndex = strrpos($selectedText, $selectedWords[$maxTokenCount - 1]);
        
           
            $finalText = substr($text, 0, $lastWordIndex + strlen($selectedWords[$maxTokenCount - 1]));
        } else {
            $finalText = $text;
        }
        $mainkeyword = $request->input('mainkeyword');

        $keywords = $this->askToChatGPT($finalText, $mainkeyword);
        return response($keywords);
    }
}
