<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- SEO Meta Tags -->
        <title>StudyTube - Learn Smarter with Timestamped YouTube Notes | Free Learning Platform</title>
        <meta name="description" content="Transform how you learn from YouTube videos. Take timestamped notes, jump to any moment instantly, and organize your learning journey. Free for students and lifelong learners.">
        <meta name="keywords" content="YouTube notes, timestamped notes, video learning, study tool, education platform, note taking, online learning, study app">
        <meta name="author" content="StudyTube">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url('/') }}">

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="StudyTube - Learn Smarter with Timestamped YouTube Notes">
        <meta property="og:description" content="Transform how you learn from YouTube videos. Take timestamped notes, jump to any moment instantly, and organize your learning journey.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:site_name" content="StudyTube">
        <meta property="og:locale" content="en_US">

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="StudyTube - Learn Smarter with Timestamped YouTube Notes">
        <meta name="twitter:description" content="Transform how you learn from YouTube videos. Take timestamped notes, jump to any moment instantly, and organize your learning journey.">

        <!-- JSON-LD Structured Data -->
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "WebApplication",
            "name": "StudyTube",
            "description": "Learn smarter with timestamped YouTube notes",
            "url": "{{ url('/') }}",
            "applicationCategory": "EducationalApplication",
            "operatingSystem": "Web",
            "offers": {
                "@@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            }
        }
        </script>

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
                    <div class="flex items-center space-x-2">
                        <span class="text-2xl">📚</span>
                        <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">StudyTube</span>
                    </div>
                    <div class="flex items-center space-x-4">
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
        <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight text-gray-900 dark:text-gray-100">
                    Learn Smarter from
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">YouTube Videos</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                    Take timestamped notes on any YouTube video and jump to any moment instantly. Never lose your place while learning.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl">
                        Start Learning Free
                    </a>
                    <a href="#how-it-works" class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-md border border-gray-200 dark:border-gray-600">
                        See How It Works
                    </a>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section id="how-it-works" class="py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900 dark:text-gray-100">
                    Simple. <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Powerful.</span> Effective.
                </h2>
                <div class="grid md:grid-cols-3 gap-12">
                    <div class="text-center">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-500 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Paste YouTube Link</h3>
                        <p class="text-gray-600 dark:text-gray-400">Add any YouTube video URL to create your video topic.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-500 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Take Timestamped Notes</h3>
                        <p class="text-gray-600 dark:text-gray-400">Write notes linked to specific timestamps as you watch.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-500 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Jump to Any Moment</h3>
                        <p class="text-gray-600 dark:text-gray-400">Click your notes to instantly jump to that timestamp in the video.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Grid -->
        <section class="py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900 dark:text-gray-100">
                    Everything You Need to Learn Better
                </h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md hover:shadow-xl transition border border-gray-200 dark:border-gray-700">
                        <div class="text-4xl mb-4">⏱️</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Precise Timestamps</h3>
                        <p class="text-gray-600 dark:text-gray-400">Every note captures the exact moment in the video for perfect reference.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md hover:shadow-xl transition border border-gray-200 dark:border-gray-700">
                        <div class="text-4xl mb-4">🎯</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Instant Navigation</h3>
                        <p class="text-gray-600 dark:text-gray-400">Click any note to jump directly to that timestamp in the video.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md hover:shadow-xl transition border border-gray-200 dark:border-gray-700">
                        <div class="text-4xl mb-4">🎨</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Rich Text Editing</h3>
                        <p class="text-gray-600 dark:text-gray-400">Format notes with markdown, code blocks, and formatting options.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md hover:shadow-xl transition border border-gray-200 dark:border-gray-700">
                        <div class="text-4xl mb-4">☁️</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Secure Cloud Storage</h3>
                        <p class="text-gray-600 dark:text-gray-400">Your notes are safely stored in the cloud. Never lose them even if you lose access to your computer.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Use Cases -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 text-gray-900 dark:text-gray-100">
                    Perfect For Every Learner
                </h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Use Case 1 -->
                    <div class="text-center">
                        <div class="text-6xl mb-4">🎓</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Students</h3>
                        <p class="text-gray-600 dark:text-gray-400">Master course materials and exam prep videos with organized, timestamped notes.</p>
                    </div>

                    <!-- Use Case 2 -->
                    <div class="text-center">
                        <div class="text-6xl mb-4">💼</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Professionals</h3>
                        <p class="text-gray-600 dark:text-gray-400">Level up your skills with technical tutorials and conference talks.</p>
                    </div>

                    <!-- Use Case 3 -->
                    <div class="text-center">
                        <div class="text-6xl mb-4">🎬</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Content Creators</h3>
                        <p class="text-gray-600 dark:text-gray-400">Research and take notes from competitor content and inspiration.</p>
                    </div>

                    <!-- Use Case 4 -->
                    <div class="text-center">
                        <div class="text-6xl mb-4">📚</div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">Lifelong Learners</h3>
                        <p class="text-gray-600 dark:text-gray-400">Build your knowledge base from documentaries and educational content.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-indigo-600 to-purple-600">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Ready to Transform Your Learning?
                </h2>
                <p class="text-xl text-indigo-100 mb-8">
                    Join thousands of learners taking smarter notes on YouTube videos.
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
                            <li><a href="#how-it-works" class="hover:text-white transition">How It Works</a></li>
                            <li><a href="#" class="hover:text-white transition">Features</a></li>
                            <li><a href="#" class="hover:text-white transition">Pricing</a></li>
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
                            <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
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
