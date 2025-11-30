<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Terms of Service - StudyTube</title>
        <meta name="description" content="Terms of Service for StudyTube - Learn smarter with timestamped YouTube notes.">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 dark:bg-gray-900">
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
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 md:p-12">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Terms of Service
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        Last updated: {{ date('F j, Y') }}
                    </p>

                    <div class="prose dark:prose-invert max-w-none">
                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">1. Acceptance of Terms</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                By accessing and using StudyTube ("the Service"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to these Terms of Service, please do not use the Service.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">2. Description of Service</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                StudyTube provides a platform for users to take timestamped notes on YouTube videos. The Service allows users to organize learning content, create notes linked to specific video timestamps, and access their notes from any device.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">3. User Accounts</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                To use certain features of the Service, you must register for an account. You agree to:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Provide accurate, current, and complete information during registration</li>
                                <li>Maintain the security of your password and account</li>
                                <li>Notify us immediately of any unauthorized use of your account</li>
                                <li>Accept responsibility for all activities that occur under your account</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">4. User Content</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You retain all rights to the notes and content you create using the Service ("User Content"). By using the Service, you grant us a limited license to store, display, and process your User Content solely for the purpose of providing the Service to you.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You are solely responsible for your User Content and agree not to post content that:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Violates any third-party rights, including copyright, trademark, or privacy rights</li>
                                <li>Contains illegal, harmful, threatening, abusive, or defamatory material</li>
                                <li>Contains viruses or malicious code</li>
                                <li>Violates any applicable laws or regulations</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">5. Acceptable Use</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You agree to use the Service only for lawful purposes and in accordance with these Terms. You agree not to:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Use the Service in any way that violates any applicable law or regulation</li>
                                <li>Attempt to gain unauthorized access to any portion of the Service</li>
                                <li>Interfere with or disrupt the Service or servers or networks connected to the Service</li>
                                <li>Use automated systems to access the Service without our written permission</li>
                                <li>Impersonate or attempt to impersonate another user or person</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">6. Premium Subscription</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                StudyTube offers a Premium subscription plan with additional features. By subscribing to Premium:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>You agree to pay the subscription fee as stated on our pricing page</li>
                                <li>Subscription fees are billed monthly and are non-refundable</li>
                                <li>You may cancel your subscription at any time, which will take effect at the end of the current billing period</li>
                                <li>We reserve the right to change subscription prices with 30 days notice</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">7. Intellectual Property</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                The Service and its original content (excluding User Content), features, and functionality are owned by StudyTube and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">8. Third-Party Services</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                The Service integrates with YouTube to display video content. Your use of YouTube content is subject to YouTube's Terms of Service. We are not responsible for the content, accuracy, or availability of YouTube or any other third-party services.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">9. Disclaimer of Warranties</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                THE SERVICE IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. WE DO NOT WARRANT THAT THE SERVICE WILL BE UNINTERRUPTED, ERROR-FREE, OR SECURE.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">10. Limitation of Liability</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                TO THE MAXIMUM EXTENT PERMITTED BY LAW, STUDYTUBE SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, OR ANY LOSS OF PROFITS OR REVENUES, WHETHER INCURRED DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOODWILL, OR OTHER INTANGIBLE LOSSES.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">11. Termination</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We may terminate or suspend your account and access to the Service immediately, without prior notice or liability, for any reason, including if you breach these Terms. Upon termination, your right to use the Service will immediately cease.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">12. Changes to Terms</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We reserve the right to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days notice prior to any new terms taking effect. Your continued use of the Service after any changes constitutes acceptance of those changes.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">13. Governing Law</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                These Terms shall be governed by and construed in accordance with the laws of the jurisdiction in which StudyTube operates, without regard to its conflict of law provisions.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">14. Contact Us</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                If you have any questions about these Terms, please contact us through our website or email us at support@studytube.com.
                            </p>
                        </section>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <span class="text-2xl">📚</span>
                    <span class="text-xl font-bold text-white">StudyTube</span>
                </div>
                <div class="flex justify-center space-x-6 text-sm mb-4">
                    <a href="{{ url('/') }}" class="hover:text-white transition">Home</a>
                    <a href="{{ route('pricing') }}" class="hover:text-white transition">Pricing</a>
                    <a href="{{ route('legal.privacy') }}" class="hover:text-white transition">Privacy Policy</a>
                    <a href="{{ route('legal.terms') }}" class="hover:text-white transition">Terms of Service</a>
                    <a href="{{ route('legal.refund') }}" class="hover:text-white transition">Refund Policy</a>
                </div>
                <p class="text-sm">&copy; {{ date('Y') }} StudyTube. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
