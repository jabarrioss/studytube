<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pricing - StudyTube</title>
        <meta name="description" content="Choose the perfect plan for your learning journey. Start free or upgrade to Premium for $5/month.">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md z-50 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <span class="text-2xl">📚</span>
                        <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">StudyTube</span>
                    </a>
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Home</a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Log in</a>
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-md">Get Started</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-32 pb-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 text-gray-900 dark:text-gray-100">
                    Simple, <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Transparent</span> Pricing
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-4">
                    Start free, upgrade when you're ready. No hidden fees.
                </p>
            </div>
        </section>

        <!-- Pricing Cards -->
        <section class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- Free Plan -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Free</h3>
                            <div class="flex items-baseline justify-center mb-4">
                                <span class="text-5xl font-extrabold text-gray-900 dark:text-gray-100">$0</span>
                                <span class="text-gray-600 dark:text-gray-400 ml-2">/month</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">Perfect for getting started</p>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Unlimited video topics</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Unlimited timestamped notes</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Secure cloud storage</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Instant video navigation</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Basic support</span>
                            </li>
                        </ul>

                        @guest
                            <a href="{{ route('register') }}" class="block w-full bg-gray-900 dark:bg-gray-700 text-white text-center py-3 rounded-lg font-semibold hover:bg-gray-800 dark:hover:bg-gray-600 transition">
                                Get Started Free
                            </a>
                        @else
                            @if(auth()->user()->plan->name === 'free')
                                <button disabled class="block w-full bg-gray-400 text-white text-center py-3 rounded-lg font-semibold cursor-not-allowed">
                                    Current Plan
                                </button>
                            @else
                                <button disabled class="block w-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-center py-3 rounded-lg font-semibold cursor-not-allowed">
                                    Not Available
                                </button>
                            @endif
                        @endguest
                    </div>

                    <!-- Premium Plan -->
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl shadow-2xl border-2 border-indigo-500 p-8 relative">
                        <div class="absolute top-0 right-6 transform -translate-y-1/2">
                            <span class="bg-yellow-400 text-gray-900 text-xs font-bold px-4 py-1 rounded-full shadow-lg">
                                MOST POPULAR
                            </span>
                        </div>
                        
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-white mb-2">Premium</h3>
                            <div class="flex items-baseline justify-center mb-4">
                                <span class="text-5xl font-extrabold text-white">$5</span>
                                <span class="text-indigo-100 ml-2">/month</span>
                            </div>
                            <p class="text-indigo-100">For serious learners</p>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white font-medium">Everything in Free, plus:</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white">Priority email support</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white">Advanced learning analytics</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white">Export notes to PDF & Markdown</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white">Early access to new features</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-white">Ad-free experience</span>
                            </li>
                        </ul>

                        @guest
                            <a href="{{ route('register') }}" class="block w-full bg-white text-indigo-600 text-center py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                                Start Free Trial
                            </a>
                        @else
                            @if(auth()->user()->plan->name === 'premium')
                                <button disabled class="block w-full bg-white/20 text-white text-center py-3 rounded-lg font-semibold cursor-not-allowed">
                                    Current Plan ✓
                                </button>
                            @else
                                <a href="{{ route('premium.index') }}" class="block w-full bg-white text-indigo-600 text-center py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                                    Upgrade to Premium
                                </a>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900 dark:text-gray-100">
                    Frequently Asked Questions
                </h2>
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Can I switch plans anytime?</h3>
                        <p class="text-gray-600 dark:text-gray-400">Yes! You can upgrade or downgrade your plan at any time. Changes take effect immediately.</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Is there a free trial for Premium?</h3>
                        <p class="text-gray-600 dark:text-gray-400">All features except Premium-exclusive ones are available in the Free plan. You can try the core functionality before upgrading.</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">What payment methods do you accept?</h3>
                        <p class="text-gray-600 dark:text-gray-400">We accept all major credit cards and payment methods through our secure payment processor.</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Can I cancel anytime?</h3>
                        <p class="text-gray-600 dark:text-gray-400">Absolutely! Cancel your Premium subscription anytime with no questions asked. Your data remains accessible.</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-md border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">What happens to my notes if I downgrade?</h3>
                        <p class="text-gray-600 dark:text-gray-400">All your notes and topics remain safe and accessible. You'll only lose access to Premium-exclusive features.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-indigo-600 to-purple-600">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Ready to Start Learning Smarter?
                </h2>
                <p class="text-xl text-indigo-100 mb-8">
                    Join thousands of learners taking better notes on YouTube videos.
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition shadow-lg hover:shadow-xl">
                    Get Started Free Today
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="text-2xl">📚</span>
                            <span class="text-xl font-bold text-white">StudyTube</span>
                        </div>
                        <p class="text-sm">Learn smarter with timestamped YouTube notes.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Product</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ url('/') }}#how-it-works" class="hover:text-white transition">How It Works</a></li>
                            <li><a href="{{ url('/') }}#features" class="hover:text-white transition">Features</a></li>
                            <li><a href="{{ route('pricing') }}" class="hover:text-white transition">Pricing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Company</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white transition">About</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Legal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('legal.privacy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                            <li><a href="{{ route('legal.terms') }}" class="hover:text-white transition">Terms of Service</a></li>
                            <li><a href="{{ route('legal.refund') }}" class="hover:text-white transition">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 text-center text-sm">
                    <p>&copy; {{ date('Y') }} StudyTube. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
