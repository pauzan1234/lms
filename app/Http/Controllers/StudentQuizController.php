<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizJawaban;
use App\Models\QuizJawabanDetail;
use Illuminate\Http\Request;

class StudentQuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $mahasiswa = auth()->user()->student;

        abort_unless($quiz->is_published, 404);

        $quiz->load('questions');

        $jawabanSaya = QuizJawaban::where('quiz_id', $quiz->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        return view('student.quiz.show', compact('quiz', 'jawabanSaya'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $mahasiswa = auth()->user()->student;

        abort_if(
            QuizJawaban::where('quiz_id', $quiz->id)->where('mahasiswa_id', $mahasiswa->id)->exists(),
            403,
            'Kamu sudah pernah mengerjakan quiz ini.'
        );

        $validated = $request->validate([
            'jawaban'   => 'required|array',
            'jawaban.*' => 'nullable|in:A,B,C,D,E',
        ]);

        $quiz->load('questions');

        $jumlahBenar = 0;

        $quizJawaban = QuizJawaban::create([
            'quiz_id'      => $quiz->id,
            'mahasiswa_id' => $mahasiswa->id,
            'waktu_submit' => now(),
        ]);

        foreach ($quiz->questions as $question) {
            $dipilih = $validated['jawaban'][$question->id] ?? null;
            $benar   = $dipilih === $question->kunci_jawaban;

            if ($benar) {
                $jumlahBenar++;
            }

            QuizJawabanDetail::create([
                'quiz_jawaban_id'  => $quizJawaban->id,
                'quiz_question_id' => $question->id,
                'jawaban_dipilih'  => $dipilih,
                'is_benar'         => $benar,
            ]);
        }

        $totalSoal = $quiz->questions->count();
        $skor = $totalSoal > 0 ? round(($jumlahBenar / $totalSoal) * 100, 2) : 0;

        $quizJawaban->update(['skor' => $skor]);

        return redirect()
            ->route('student.quiz.show', $quiz->id)
            ->with('success', "Quiz selesai! Skor kamu: {$skor}");
    }
}
