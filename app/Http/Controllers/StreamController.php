<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class StreamController extends Controller
{
    public function CreatePostByGPT(Request $request)
    {
        $keywords = $request->input('keywords');
        $title = $request->input('title');
        $stringKeyword = implode(', ', $keywords);

        $question = 'Từ các keyword : '. $stringKeyword .'. Hãy tạo nội dung bài viết với tiêu đề là: '.$title;
        return response()->stream(function () use ($question){
            $stream = OpenAI::completions()->createStreamed([
                'model' => 'text-davinci-003',
                'prompt' => $question,
                'max_tokens' => 1024,
            ]);

            foreach ($stream as $response) {
                $text = $response->choices[0]->text;
                if (connection_aborted()) {
                    break;
                }

                echo "event: update\n";
                echo 'data: ' . $text;
                echo "\n\n";
                ob_flush();
                flush();
            }

            echo "event: update\n";
            echo 'data: <END_STREAMING_SSE>';
            echo "\n\n";
            ob_flush();
            flush();
        }, 200, [
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
            'Content-Type' => 'text/event-stream',
        ]);
    }
}
