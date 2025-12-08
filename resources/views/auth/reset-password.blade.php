{{-- @extends('layouts.app') --}} 

{{-- @section('content') --}}

<div style="max-width: 400px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    
    <h2>Reset Your Password</h2>

    @if (session('status'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email', $request->email) }}" 
                required 
                autofocus 
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
            >
            
            @error('email')
                <p style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Password</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
            >
            
            @error('password')
                <p style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: bold;">Confirm Password</label>
            <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                required 
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
            >
        </div>

        <div>
            <button 
                type="submit" 
                style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;"
            >
                Reset Password
            </button>
        </div>
        
    </form>

</div>

{{-- @endsection --}}