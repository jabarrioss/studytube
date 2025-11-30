<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Refund Policy - StudyTube</title>
        <meta name="description" content="Refund Policy for StudyTube - Learn smarter with timestamped YouTube notes.">
        
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
                        Refund Policy
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        Last updated: {{ date('F j, Y') }}
                    </p>

                    <div class="prose dark:prose-invert max-w-none">
                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">1. Overview</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                At StudyTube, we want you to be completely satisfied with your purchase. This Refund Policy explains our policies regarding refunds for our Premium subscription service.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">2. Free Plan</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Our Free plan is available at no cost and does not involve any payment or refund considerations. You can use the Free plan indefinitely without any charges.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">3. Premium Subscription Refunds</h2>
                            
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3 mt-6">3.1 30-Day Money-Back Guarantee</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We offer a <strong>30-day money-back guarantee</strong> for first-time Premium subscribers. If you are not satisfied with your Premium subscription within the first 30 days of your initial purchase, you can request a full refund.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                To qualify for the 30-day money-back guarantee:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>This is your first Premium subscription purchase with StudyTube</li>
                                <li>You must request the refund within 30 days of your initial purchase date</li>
                                <li>Your account must be in good standing with no violations of our Terms of Service</li>
                            </ul>

                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3 mt-6">3.2 Recurring Subscriptions</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                After the initial 30-day period, Premium subscriptions are billed monthly at $5 USD per month. These recurring charges are <strong>non-refundable</strong> except in the following circumstances:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Billing errors or duplicate charges</li>
                                <li>Unauthorized charges (subject to verification)</li>
                                <li>Technical issues that prevented you from accessing the service for an extended period</li>
                            </ul>

                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3 mt-6">3.3 Subscription Cancellation</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You can cancel your Premium subscription at any time through your account settings or by contacting our support team. Upon cancellation:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>You will retain Premium access until the end of your current billing period</li>
                                <li>You will not be charged for subsequent billing periods</li>
                                <li>No refund will be provided for the remaining days in your current billing period</li>
                                <li>All your notes and topics will remain accessible, but Premium features will be disabled</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">4. How to Request a Refund</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                To request a refund that qualifies under this policy, please follow these steps:
                            </p>
                            <ol class="list-decimal pl-6 text-gray-700 dark:text-gray-300 space-y-3 mb-4">
                                <li>
                                    <strong>Contact Support:</strong> Send an email to <a href="mailto:support@studytube.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">support@studytube.com</a> with the subject line "Refund Request"
                                </li>
                                <li>
                                    <strong>Provide Information:</strong> Include the following in your email:
                                    <ul class="list-disc pl-6 mt-2 space-y-1">
                                        <li>Your account email address</li>
                                        <li>The date of your purchase</li>
                                        <li>The reason for your refund request</li>
                                        <li>Any relevant details about your experience</li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Wait for Response:</strong> Our support team will review your request within 2-3 business days
                                </li>
                                <li>
                                    <strong>Receive Refund:</strong> If approved, refunds will be processed to your original payment method within 5-10 business days
                                </li>
                            </ol>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">5. Non-Refundable Situations</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Refunds will NOT be provided in the following situations:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Subscription renewals after the initial 30-day period</li>
                                <li>Partial month refunds (except in cases of billing errors)</li>
                                <li>Accounts that have been suspended or terminated for violating our Terms of Service</li>
                                <li>Change of mind after the 30-day guarantee period</li>
                                <li>Failure to cancel before the next billing cycle</li>
                                <li>Lack of use of the Premium features</li>
                                <li>Previous refunds already granted to the same account</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">6. Billing Errors</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                If you believe you've been incorrectly charged, please contact us immediately at <a href="mailto:billing@studytube.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">billing@studytube.com</a>. We will investigate all billing error claims promptly and issue refunds for verified errors within 5-10 business days.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Common billing errors we address include:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Duplicate charges</li>
                                <li>Charges after cancellation was properly processed</li>
                                <li>Incorrect subscription amount charged</li>
                                <li>Currency conversion errors</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">7. Unauthorized Transactions</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                If you notice unauthorized charges on your account, please:
                            </p>
                            <ol class="list-decimal pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Contact your financial institution immediately to report the unauthorized transaction</li>
                                <li>Notify us at <a href="mailto:security@studytube.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">security@studytube.com</a> with details of the unauthorized charge</li>
                                <li>Change your account password immediately</li>
                            </ol>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We will fully cooperate with any investigation and issue refunds for verified unauthorized transactions.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">8. Processing Time</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Once a refund is approved:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li><strong>Processing:</strong> We process approved refunds within 2-3 business days</li>
                                <li><strong>Credit Card Refunds:</strong> Typically appear within 5-10 business days, depending on your card issuer</li>
                                <li><strong>Other Payment Methods:</strong> May take up to 14 business days depending on the payment processor</li>
                            </ul>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                You will receive an email confirmation once the refund has been processed from our end.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">9. Account Access After Refund</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                If you receive a refund for your Premium subscription:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Your account will be immediately downgraded to the Free plan</li>
                                <li>Premium features will no longer be accessible</li>
                                <li>All your notes, topics, and data will remain intact and accessible</li>
                                <li>You can re-subscribe to Premium at any time (subject to this refund policy)</li>
                            </ul>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">10. Dispute Resolution</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                If you disagree with a refund decision, you may:
                            </p>
                            <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li>Request a review by escalating your case to our senior support team</li>
                                <li>Provide additional information or documentation to support your request</li>
                                <li>Contact your payment provider to initiate a chargeback (though we encourage resolving disputes directly with us first)</li>
                            </ul>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We are committed to fair treatment of all refund requests and will work with you to find a satisfactory resolution.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">11. Changes to This Policy</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                We reserve the right to modify this Refund Policy at any time. Any changes will be effective immediately upon posting on this page with an updated "Last updated" date. Your continued use of the Service after changes are posted constitutes acceptance of the updated policy.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Material changes that affect your refund rights will be communicated via email to all active Premium subscribers at least 30 days before taking effect.
                            </p>
                        </section>

                        <section class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">12. Contact Information</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                If you have any questions about this Refund Policy or need assistance with a refund request, please contact us:
                            </p>
                            <ul class="list-none text-gray-700 dark:text-gray-300 space-y-2 mb-4">
                                <li><strong>General Support:</strong> <a href="mailto:support@studytube.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">support@studytube.com</a></li>
                                <li><strong>Billing Questions:</strong> <a href="mailto:billing@studytube.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">billing@studytube.com</a></li>
                                <li><strong>Website:</strong> <a href="{{ url('/') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ url('/') }}</a></li>
                            </ul>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Our support team typically responds within 24-48 hours during business days.
                            </p>
                        </section>

                        <section class="mb-8">
                            <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-indigo-900 dark:text-indigo-100 mb-3">💡 Quick Summary</h3>
                                <ul class="list-disc pl-6 text-indigo-800 dark:text-indigo-200 space-y-2 text-sm">
                                    <li><strong>First 30 days:</strong> Full refund available for first-time Premium subscribers</li>
                                    <li><strong>After 30 days:</strong> Monthly charges are non-refundable (except billing errors)</li>
                                    <li><strong>Cancel anytime:</strong> No charges after cancellation, access until period ends</li>
                                    <li><strong>Your data is safe:</strong> All notes remain accessible even after refund or cancellation</li>
                                    <li><strong>Quick processing:</strong> Approved refunds processed within 2-3 business days</li>
                                </ul>
                            </div>
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
