<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-medium leading-tight text-gray-800 sm:text-6xl">
            {{ __('Help') }}
        </h2>
    </x-slot>   

    <div class="px-4 pb-12 mx-auto space-y-6 sm:px-6 lg:px-8 max-w-7xl">
        <p class="pb-12 text-lg text-gray-600 sm:text-2xl">Our help center</p>
        
        <p class="text-lg text-gray-600">
            Welcome to our Help page! Here, you will find answers to common questions and useful information to help you navigate our platform.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">1. Frequently Asked Questions (FAQs)</h3>
        <p class="text-lg text-gray-600">
            <strong>Q: How do I create an account?</strong><br>
            A: Click on the "Sign Up" button on the top right corner of the page. Follow the prompts to enter your information and create your account.
        </p>
        <p class="text-lg text-gray-600">
            <strong>Q: How can I reset my password?</strong><br>
            A: On the login page, click the "Forgot Password" link. Enter your email address, and you will receive instructions on how to reset your password.
        </p>
        <p class="text-lg text-gray-600">
            <strong>Q: How do I apply for a job?</strong><br>
            A: Browse through the job openings on our platform, select the one you're interested in, and click "Apply." Follow the instructions to submit your application.
        </p>

        <h3 class="text-2xl font-semibold text-gray-800">2. Contact Us</h3>
        <p class="text-lg text-gray-600">
            If you need further assistance or have specific questions that are not covered in the FAQs, please reach out to our support team. You can contact us via:
        </p>
        <ul class="pl-6 text-lg text-gray-600 list-disc">
            <li><strong>Email:</strong> support@example.com</li>
            <li><strong>Phone:</strong> +1 (123) 456-7890</li>
            <li><strong>Live Chat:</strong> Available on our website from 9 AM to 5 PM (EST)</li>
        </ul>

        <h3 class="text-2xl font-semibold text-gray-800">3. Explore More</h3>
        <p class="text-lg text-gray-600">
            While you're here, you might find these features interesting:
        </p>
        <ul class="pl-6 text-lg text-gray-600 list-disc">
            <li><a href="#" class="text-blue-500 hover:underline">Feature Overview</a> - Learn about the key features of our platform.</li>
            <li><a href="#" class="text-blue-500 hover:underline">Upcoming Releases</a> - Get a sneak peek at what's coming next.</li>
            <li><a href="#" class="text-blue-500 hover:underline">User Stories</a> - Read about how others are using our platform to succeed.</li>
        </ul>

        <p class="text-lg text-gray-600">
            We are here to help you make the most of our platform. If you have any feedback or suggestions, please let us know!
        </p>
    </div>
</x-app-layout>