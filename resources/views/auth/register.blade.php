@extends('layouts.app', ['title' => 'Deals Gorilla Register'])

@section('content')
    <main class="max-w-7xl mx-auto p-6 my-10">
        <div class="bg-white panel content-card overflow-hidden lg:flex lg:shadow-lg rounded-md">
            <!-- Login form -->
            <div class="lg:w-1/2 px-8 py-10 md:px-12 md:py-14">
                <h1 class="text-2xl sm:text-3xl font-extrabold mb-0">Create account</h1>
                <p class=" mb-6">Create your account to get started — it's quick and easy.</p>

                <form class="space-y-4" action="#" method="POST" onsubmit="event.preventDefault(); alert('Account created (demo)')">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="block">
                            <span class="sr-only">First name</span>
                            <input required name="first" placeholder="First Name" type="text"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>

                        <label class="block">
                            <span class="sr-only">Last name</span>
                            <input required name="last" placeholder="Last Name" type="text"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>
                    </div>

                    <div>
                        <label class="block">
                            <span class="sr-only">Email</span>
                            <input required name="email" placeholder="Email Address" type="email"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="block">
                            <span class="sr-only">Password</span>
                            <input required name="password" placeholder="Password" type="password"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>

                        <label class="block">
                            <span class="sr-only">Confirm password</span>
                            <input required name="confirm" placeholder="Confirm Password" type="password"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>
                    </div>

                    <div class="space-y-3 mt-3">
                        <label class="custom-checkbox gap-3 text-sm text-slate-700">
                            <input type="checkbox" name="newsletter" />
                            <span>Sign Up for Newsletter to Get £160 Off Coupon Bundle</span>
                        </label>
                    </div>

                    <div class="mt-3">
                        <div class="captcha-placeholder">
                            <div class="flex items-center gap-4">
                                <div class="text-sm text-slate-600">I'm not a robot — reCAPTCHA placeholder</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-amber-400 hover:bg-amber-500 text-white rounded-md py-3 font-semibold mt-4">
                            Register
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
                            <h3 class="text-2xl font-semibold text-slate-800 mb-2">Return to Sign in</h3>
                            <p class="text-sm text-slate-500 mb-4">Already have an account?</p>
                            <a href="/login"
                                class="inline-block w-full text-center pointer-events-auto cta-pill bg-slate-800 hover:bg-slate-900 text-white font-medium rounded-md py-3">
                                Sign In
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block absolute -left-6 top-0 bottom-0 w-6 bg-transparent"></div>
            </div>
        </div>
    </main>
@endsection
