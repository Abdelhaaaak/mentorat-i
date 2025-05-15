<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SessionMMController;
use App\Http\Controllers\LyceeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AIController;

// 🌐 Accueil public ou redirection
Route::get('/', function () {
    if (!auth()->check()) {
        return view('home'); // page d’accueil guest
    }

    return auth()->user()->role === 'mentor'
        ? redirect()->route('mentor.dashboard')
        : redirect()->route('mentee.dashboard');
})->name('home');

// 📦 Tableau de bord général
Route::get('/dashboard', function () {
    return auth()->user()->role === 'mentor'
        ? redirect()->route('mentor.dashboard')
        : redirect()->route('mentee.dashboard');
})->middleware('auth')->name('dashboard');

// 🔔 Marquer les notifications comme lues
Route::post('/notifications/read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return response()->json(['ok' => true]);
})->middleware('auth')->name('notifications.read');

// 🧭 Authentification Laravel native
require __DIR__.'/auth.php';

// 👥 Inscriptions personnalisées
Route::middleware('guest')->group(function () {
    Route::get('/register/mentee', [RegisteredUserController::class, 'showMentee'])->name('register.mentee');
    Route::post('/register/mentee', [RegisteredUserController::class, 'storeMentee'])->name('register.mentee.store');

    Route::get('/register/mentor', [RegisteredUserController::class, 'showMentor'])->name('register.mentor');
    Route::post('/register/mentor', [RegisteredUserController::class, 'storeMentor'])->name('register.mentor.store');
});

// 🌍 Page publique des mentors
Route::get('/profiles', [UserProfileController::class, 'index'])->name('profile.index');
Route::get('/profiles/{user}', [UserProfileController::class, 'show'])->name('profile.show');



// 🔒 Routes protégées
Route::middleware('auth')->group(function () {

    // 🧑‍🎓 Dashboards
    Route::get('/dashboard/mentee', [DashboardController::class, 'mentee'])->name('mentee.dashboard');
    Route::get('/dashboard/mentor', [DashboardController::class, 'mentor'])->name('mentor.dashboard');

    // 🤖 IA
    Route::get('/mentor/ai', [AIController::class, 'find'])->name('mentor.ai');

    // 👤 Profil personnel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ➕/➖ Suivre un mentor
    Route::post('/follow/{user}', [UserProfileController::class, 'toggleFollow'])->name('follow.toggle');

    // 🛠 Compétences
    Route::get('/skills', [ProfileController::class, 'skills'])->name('skills.index');
    Route::post('/skills', [ProfileController::class, 'storeSkill'])->name('skills.store');
    Route::delete('/skills/{skill}', [ProfileController::class, 'destroySkill'])->name('skills.destroy');

    // 📆 Sessions de mentorat
    Route::prefix('sessions')->group(function () {
        Route::get('/', [SessionMMController::class, 'index'])->name('sessions.index');
        Route::post('/', [SessionMMController::class, 'store'])->name('sessions.store');
        Route::patch('/{session}/status', [SessionMMController::class, 'updateStatus'])->name('sessions.update');
    });

    // 📅 Réservation de session (mentor sélectionné)
    Route::get('/book/{mentor}', [SessionMMController::class, 'create'])->name('sessions.create');

    // 💬 Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // 🌟 Feedback
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/feedback/{feedback}', [FeedbackController::class, 'show'])->name('feedback.show');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
});
