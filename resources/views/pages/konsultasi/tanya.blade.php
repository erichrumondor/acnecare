@extends('layouts.app')
@section('title', 'Konsultasi — Pertanyaan')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:620px; margin:2rem auto; padding:0 1rem; }
    .progress-wrap { margin-bottom:2rem; }
    .progress-bar-custom { height:6px; background:var(--ac-border); border-radius:999px; overflow:hidden; }
    .progress-fill { height:100%; background:var(--ac-green); border-radius:999px; transition:width .4s; }
    .question-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; }
    .question-num { font-size:.775rem; font-weight:700; color:var(--ac-green); text-transform:uppercase; letter-spacing:.08em; margin-bottom:.75rem; }
    .question-text { font-size:1.15rem; font-weight:600; color:var(--ac-green-dark); line-height:1.6; margin-bottom:2rem; }
    .answer-btn { display:flex; align-items:center; gap:14px; width:100%; padding:1rem 1.25rem; border:1.5px solid var(--ac-border); border-radius:14px; background:#fff; cursor:pointer; transition:all .15s; margin-bottom:.75rem; text-align:left; }
    .answer-btn:hover { border-color:var(--ac-green); background:var(--ac-green-light); }
    .answer-btn.ya:hover { border-color:#1D9E75; }
    .answer-btn.tidak:hover { border-color:#D85A30; background:#FAECE7; }
    .answer-icon { width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.25rem; flex-shrink:0; }
    .answer-icon.ya { background:#E1F5EE; }
    .answer-icon.tidak { background:#FAECE7; }
    .answer-label { font-size:1rem; font-weight:600; }
    .answer-sub { font-size:.8rem; color:var(--ac-muted); margin-top:2px; }
    .tip-box { background:#E6F1FB; border-radius:12px; padding:.875rem 1rem; font-size:.825rem; color:#185FA5; margin-top:1.25rem; }
</style>
@endpush

@section('content')
<div class="ac-main">
    {{-- Progress --}}
    <div class="progress-wrap">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span style="font-size:.8rem;font-weight:600;color:var(--ac-green-dark)">
                Pertanyaan {{ $nomor }} dari {{ $total }}
            </span>
            <span style="font-size:.8rem;color:var(--ac-muted)">
                {{ round(($nomor / $total) * 100) }}% selesai
            </span>
        </div>
        <div class="progress-bar-custom">
            <div class="progress-fill" style="width:{{ ($nomor / $total) * 100 }}%"></div>
        </div>
    </div>

    {{-- Pertanyaan --}}
    <div class="question-card">
        <div class="question-num">
            <i class="bi bi-clipboard2-pulse me-1"></i>Konsultasi Jerawat · AAD Classification
        </div>
        <div class="question-text">{{ $pertanyaan->pertanyaan }}</div>

        <form method="POST" action="{{ route('konsultasi.jawab') }}">
            @csrf
            <input type="hidden" name="nomor" value="{{ $nomor }}">
            <input type="hidden" name="history" value="{{ $history ?? '[]' }}">

            <button type="submit" name="jawaban" value="ya" class="answer-btn ya">
                <div class="answer-icon ya">
                    <i class="bi bi-check-lg" style="color:#1D9E75"></i>
                </div>
                <div>
                    <div class="answer-label" style="color:#085041">Ya</div>
                    <div class="answer-sub">Kondisi ini sesuai dengan kulitku</div>
                </div>
            </button>

            <button type="submit" name="jawaban" value="tidak" class="answer-btn tidak">
                <div class="answer-icon tidak">
                    <i class="bi bi-x-lg" style="color:#D85A30"></i>
                </div>
                <div>
                    <div class="answer-label" style="color:#993C1D">Tidak</div>
                    <div class="answer-sub">Kondisi ini tidak sesuai dengan kulitku</div>
                </div>
            </button>
        </form>

        <div class="tip-box">
            <i class="bi bi-lightbulb me-2"></i>
            <strong>Tips:</strong> Periksa kulitmu langsung di depan cermin dengan pencahayaan cukup sebelum menjawab.
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('konsultasi') }}" style="font-size:.8rem;color:var(--ac-muted);text-decoration:none">
            <i class="bi bi-x-circle me-1"></i>Batalkan konsultasi
        </a>
    </div>
</div>
@endsection