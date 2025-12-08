{{-- @extends('layouts.app') --}} 

{{-- @section('content') --}}

<div style="max-width: 400px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    
    <h2>Forgot Your Password?</h2>

    @if (session('status'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif

    <p style="margin-bottom: 20px; color: #666;">
        No problem! Just let us know your email address and we will email you a password reset link.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
            >
            
            @error('email')
                <p style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-top: 20px;">
            <button 
                type="submit" 
                style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;"
            >
                Email Password Reset Link
            </button>
        </div>
        
        <div style="margin-top: 15px; text-align: center;">
            <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none;">
                Back to Login
            </a>
        </div>
        
    </form>

</div>

{{-- @endsection --}}