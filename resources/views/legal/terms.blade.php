<x-app-layout>
    <x-slot name="header">
        <h2 class="text-6xl font-medium leading-tight text-gray-800">
            {{ __('Terms and Conditions') }}
        </h2>
    </x-slot>   

    <div class="p-4 mx-auto sm:px-6 lg:px-8 max-w-7xl space-y-6">
        <p class="text-lg text-gray-600">
            Welcome to our platform. By using our services, you agree to be bound by the following terms and conditions. Please read them carefully as they outline your rights and responsibilities as a user of our site.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">1. Use of Services</h3>
        <p class="text-lg text-gray-600">
            Our platform is designed to streamline the job search process for developers. You agree to use the site only for lawful purposes and in a way that does not infringe on the rights of others. Misuse of the platform or engagement in prohibited activities will result in the termination of your account.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">2. Account Registration</h3>
        <p class="text-lg text-gray-600">
            You must provide accurate information when creating an account. It is your responsibility to keep your account details secure and to notify us of any unauthorized use of your account. We are not liable for any loss or damage arising from your failure to maintain the confidentiality of your login credentials.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">3. Job Applications</h3>
        <p class="text-lg text-gray-600">
            Our platform simplifies the application process, allowing you to apply directly without filling out tedious forms. However, you must ensure that the information you provide is accurate and up-to-date. We are not responsible for the outcome of any job applications or hiring decisions.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">4. Privacy</h3>
        <p class="text-lg text-gray-600">
            Your privacy is important to us. Please refer to our <a class="hover:underline" href="{{ route('privacy')}}">Privacy Policy</a> for information on how we collect, use, and protect your personal data. By using our platform, you consent to the handling of your data in accordance with our policy.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">5. Liability</h3>
        <p class="text-lg text-gray-600">
            We strive to provide accurate and reliable information, but we cannot guarantee that our platform will be error-free or uninterrupted. You use the platform at your own risk, and we are not liable for any damages or losses resulting from your use of the site.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">6. Changes to Terms</h3>
        <p class="text-lg text-gray-600">
            We may update these terms from time to time. If any changes are made, we will notify users by updating the date of the terms at the bottom of this page. Continued use of the platform after changes have been made constitutes acceptance of the new terms.
        </p>

        <p class="text-lg text-gray-600">
            These terms are effective as of {{ Carbon\Carbon::now()->toDayDateTimeString() }}. If you have any questions or concerns, feel free to contact our support team.
        </p>
    </div>
</x-app-layout>