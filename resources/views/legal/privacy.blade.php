<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Privacy Policy - StudyTube</title>
        <meta name="description" content="Privacy Policy for StudyTube - Learn smarter with timestamped YouTube notes.">
        
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
                        Privacy Policy
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        Last updated: {{ date('F j, Y') }}
                    </p>

                    <div class="prose dark:prose-invert max-w-none">
                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">1. Introduction</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Welcome to StudyTube ("we," "our," or "us"). We respect your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our service.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">2. Information We Collect</h2>
                            
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3 mt-6">2.1 Information You Provide</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We collect information that you voluntarily provide to us when you:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Register for an account (name, email address, password)</li>
                                <li>Create learning topics and notes</li>
                                <li>Subscribe to our Premium plan</li>
                                <li>Contact our support team</li>
                                <li>Sign in through third-party authentication (Google OAuth)</li>
                            </ul>

                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3 mt-6">2.2 Automatically Collected Information</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                When you use our Service, we automatically collect certain information:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Device information (browser type, operating system, device type)</li>
                                <li>Usage data (pages visited, features used, time spent on the Service)</li>
                                <li>IP address and general location information</li>
                                <li>Cookies and similar tracking technologies</li>
                            </ul>

                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3 mt-6">2.3 User-Generated Content</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We store the content you create using our Service, including:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Learning topics and video references</li>
                                <li>Timestamped notes and annotations</li>
                                <li>Learning session data and progress</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">3. How We Use Your Information</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We use the collected information for various purposes:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>To provide, maintain, and improve our Service</li>
                                <li>To process your registration and manage your account</li>
                                <li>To process payments and prevent fraud</li>
                                <li>To send you technical notices, updates, and support messages</li>
                                <li>To respond to your comments and questions</li>
                                <li>To analyze usage patterns and optimize user experience</li>
                                <li>To comply with legal obligations</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">4. Data Storage and Security</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We implement appropriate technical and organizational security measures to protect your personal information:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Your data is stored securely in isolated databases</li>
                                <li>We use encryption to protect data in transit (HTTPS/SSL)</li>
                                <li>Passwords are hashed and never stored in plain text</li>
                                <li>Access to personal data is restricted to authorized personnel only</li>
                                <li>Regular security audits and updates</li>
                            </ul>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                However, no method of transmission over the Internet is 100% secure, and we cannot guarantee absolute security.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">5. Data Sharing and Disclosure</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li><strong>Service Providers:</strong> We may share data with third-party service providers who perform services on our behalf (e.g., payment processing, email delivery)</li>
                                <li><strong>Legal Requirements:</strong> We may disclose your information if required by law or in response to valid legal requests</li>
                                <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred</li>
                                <li><strong>With Your Consent:</strong> We may share your information with your explicit consent</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">6. Third-Party Services</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Our Service integrates with third-party services:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li><strong>YouTube:</strong> We embed YouTube videos. YouTube's privacy policy applies to video content</li>
                                <li><strong>Google OAuth:</strong> If you sign in with Google, Google's privacy policy applies to that authentication</li>
                                <li><strong>Payment Processors:</strong> Payment information is processed by our payment partners (Shopify) and is subject to their privacy policies</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">7. Your Rights and Choices</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You have certain rights regarding your personal information:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li><strong>Access:</strong> You can access and review your personal information through your account settings</li>
                                <li><strong>Correction:</strong> You can update or correct your personal information at any time</li>
                                <li><strong>Deletion:</strong> You can request deletion of your account and associated data</li>
                                <li><strong>Data Portability:</strong> Premium users can export their notes and data</li>
                                <li><strong>Opt-Out:</strong> You can opt-out of marketing communications</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">8. Cookies and Tracking Technologies</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We use cookies and similar tracking technologies to:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Maintain your session and keep you logged in</li>
                                <li>Remember your preferences</li>
                                <li>Understand how you use our Service</li>
                                <li>Improve our Service performance</li>
                            </ul>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You can control cookies through your browser settings, but disabling cookies may limit some functionality.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">9. Children's Privacy</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Our Service is not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If you are a parent or guardian and believe we have collected information from your child, please contact us.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">10. International Data Transfers</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Your information may be transferred to and maintained on servers located outside of your state, province, country, or other governmental jurisdiction where data protection laws may differ. By using our Service, you consent to this transfer.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">11. Data Retention</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We retain your personal information for as long as necessary to provide our Service and fulfill the purposes outlined in this Privacy Policy. When you delete your account, we will delete or anonymize your personal information, except where we are required to retain it for legal purposes.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">12. Changes to This Privacy Policy</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date. You are advised to review this Privacy Policy periodically for any changes.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">13. Contact Us</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                If you have any questions about this Privacy Policy or our data practices, please contact us:
                            </p>
                            <ul class="list-none text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Email: privacy@studytube.com</li>
                                <li>Website: {{ url('/') }}</li>
                            </ul>
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
