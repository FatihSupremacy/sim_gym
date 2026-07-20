@extends('layout.master')

@section('content')
<style>
    .account-shell {
        min-height: calc(100vh - 48px);
        padding: 16px;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* background: #F8FAFC; */
    }

    .account-kicker {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 4px;
        color: #1F2937;
    }

    .account-subtitle {
        color: #6B7280;
        font-size: 1rem;
        margin-bottom: 24px;
    }

    .account-card {
        width: 100%;
        max-width: 520px;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        background: #FFFFFF;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 30px 34px;
    }

    .profile-top {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 22px;
    }

    .profile-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(140deg, #5c7cff 0%, #4958ee 100%);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        font-weight: 700;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .24);
    }

    .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        color: #1F2937;
    }

    .profile-email {
        margin: 4px 0 0;
        font-size: .95rem;
        color: #6B7280;
    }

    .profile-grid {
        margin-top: 18px;
    }

    .profile-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border-top: 1px solid #F3F4F6;
        padding: 14px 0;
    }

    .profile-label {
        margin: 0;
        font-size: .95rem;
        color: #6B7280;
    }

    .profile-value {
        margin: 0;
        text-align: right;
        font-size: .95rem;
        color: #1F2937;
        font-weight: 600;
        word-break: break-word;
    }

    .signout-btn {
        margin-top: 24px;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #DC2626;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .signout-btn:hover {
        background: #FEE2E2;
        color: #B91C1C;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        #main>.page-content {
            background: transparent !important;
        }

        .account-shell {
            min-height: auto;
            border-radius: 14px;
        }

        .account-card {
            padding: 22px 18px;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            font-size: 1.4rem;
        }

        .profile-name {
            font-size: 1.25rem;
        }

        .profile-email {
            font-size: .9rem;
        }

        .profile-label,
        .profile-value {
            font-size: .9rem;
        }
    }
</style>

@php
$profileInitial = strtoupper(substr($user->name ?? 'U', 0, 1));
@endphp

<div class="account-shell">
    <div class="account-card">
        <div class="profile-top">
            <span class="profile-avatar">{{ $profileInitial }}</span>
            <div>
                <h2 class="profile-name">{{ $user->name }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
            </div>
        </div>

        <div class="profile-grid">
            <div class="profile-row">
                <p class="profile-label">User ID</p>
                <p class="profile-value">{{ $user->id }}</p>
            </div>
            <div class="profile-row">
                <p class="profile-label">Email</p>
                <p class="profile-value">{{ $user->email }}</p>
            </div>
            <div class="profile-row">
                <p class="profile-label">Member since</p>
                <p class="profile-value">{{ optional($user->created_at)->format('d M Y') ?? '-' }}</p>
            </div>
            <div class="profile-row">
                <p class="profile-label">Account Status</p>
                <p class="profile-value">{{ ucfirst($user->status ?? '-') }}</p>
            </div>
            <div class="profile-row">
                <p class="profile-label">Role</p>
                <p class="profile-value">{{ ucfirst($user->role ?? '-') }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="signout-btn">
            <i class="bi bi-power me-1"></i> Sign Out
        </button>
    </form>
</div>
@endsection