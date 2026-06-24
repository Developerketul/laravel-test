@extends('layouts.app')

@section('content')

<section class="content pt-3">
    <div class="container-fluid">

        <x-errors />

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success">
                {{ __('Saved.') }}
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="alert alert-success">
                {{ __('Saved.') }}
            </div>
        @endif

        @if (session('status') === 'verification-link-sent')
            <div class="alert alert-success">
                {{ __('A new verification link has been sent to your email address.') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-header">{{ __('Profile Information') }}</div>
            <div class="card-body">
                <p class="text-muted">{{ __("Update your account's profile information and email address.") }}</p>

                <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert alert-warning">
                            <div>{{ __('Your email address is unverified.') }}</div>
                            <button type="submit" form="send-verification" class="btn btn-sm btn-outline-primary mt-2">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </div>
                    @endif

                    <button class="btn btn-primary">{{ __('Save') }}</button>
                </form>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">{{ __('Update Password') }}</div>
            <div class="card-body">
                <p class="text-muted">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                        @if ($errors->updatePassword->has('current_password'))
                            <div class="text-danger small mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('New Password') }}</label>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                        @if ($errors->updatePassword->has('password'))
                            <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                        @if ($errors->updatePassword->has('password_confirmation'))
                            <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <button class="btn btn-success">{{ __('Update') }}</button>
                </form>
            </div>
        </div>

        <div class="card card-danger">
            <div class="card-header">{{ __('Delete Account') }}</div>
            <div class="card-body">
                <p class="text-muted mb-3">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">{{ __('Delete Account') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('profile.destroy') }}">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')

                    <p>{{ __('Are you sure you want to delete your account?') }}</p>
                    <p class="text-muted">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>

                    <div class="mb-0">
                        <label for="delete_password" class="form-label">{{ __('Password') }}</label>
                        <input id="delete_password" name="password" type="password" class="form-control" required>
                        @if ($errors->userDeletion->has('password'))
                            <div class="text-danger small mt-1">{{ $errors->userDeletion->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalElement = document.getElementById('deleteAccountModal');
                if (!modalElement || !window.bootstrap) {
                    return;
                }

                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            });
        </script>
    @endif
@endpush
