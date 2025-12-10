@extends('layouts.app', ['title' => 'Deals Gorilla Login'])

@section('content')
    <main class="max-w-7xl mx-auto p-6 my-10">
        <div class="bg-white panel content-card overflow-hidden lg:flex lg:shadow-lg rounded-md">
            <!-- Login form -->
            <div class="lg:w-1/2 px-8 py-10 md:px-12 md:py-14">
                <h1 class="text-2xl sm:text-3xl font-extrabold mb-8">Login</h1>

                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="sr-only">Email Address</label>
                        <input name="email" type="email"
                            placeholder="Email Address"
                            class="w-full rounded-md border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-violet-300" />
                        @error('email')
                            <span class="invalid_feedback">
                                <strong class="text-sm text-red-600">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input name="password" type="password" 
                            placeholder="Password"
                            class="w-full rounded-md border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-violet-300" />
                        @error('password')
                            <span class="invalid_feedback">
                                <strong class="text-sm text-red-600">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="space-y-3 mt-3">
                        <label class="custom-checkbox gap-3 text-sm text-slate-700">
                            <input type="checkbox" name="newsletter" />
                            <span>Remember Me</span>
                        </label>

                        <a href="#" class="text-slate-600 hover:underline mt-0 float-end">Forgot your password?</a>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-orange-400 hover:bg-orange-500 text-white rounded-md py-3 font-semibold shadow-sm">
                            Login
                        </button>
                    </div>
                </form>
                <div class="mt-8 text-xs text-slate-500">
                    By logging in you agree to our <a href="#" class="underline">Terms & Conditions</a>.
                </div>
            </div>
            <div class="lg:w-1/2 relative">
                <div class="h-64 sm:h-80 lg:h-full bg-cover bg-center"
                    style="background-image: url('{{ asset('assets/images/login-bg.webp') }}');">
                    <div class="h-full w-full bg-gradient-to-b from-transparent to-white/60"></div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="max-w-sm w-full px-6 py-3 pointer-events-auto">
                        <div class="bg-white/90 backdrop-blur-sm rounded-md p-6 text-center">
                            <h3 class="text-2xl font-semibold text-slate-800 mb-2">New to Costway?</h3>
                            <p class="text-sm text-slate-500 mb-4">Get started now. It's fast and easy!</p>
                            <a href="/register"
                                class="inline-block w-full text-center pointer-events-auto cta-pill bg-slate-800 hover:bg-slate-900 text-white font-medium rounded-md py-3">
                                Create Account
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block absolute -left-6 top-0 bottom-0 w-6 bg-transparent"></div>
            </div>
        </div>
    </main>
@endsection
