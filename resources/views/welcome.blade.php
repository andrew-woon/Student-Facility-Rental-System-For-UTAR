<style>
    .transition-background {
        animation: slideBackground 20s infinite;
        background-size: cover;
        background-position: center;
    }

    @keyframes slideBackground {
        0% {
            background-image: url('{{ asset('images/UTAR_Kampar.jpg') }}');
        }
        50% {
            background-image: url('{{ asset('images/UTAR_SL.jpg') }}');
        }
        100% {
            background-image: url('{{ asset('images/UTAR_Kampar.jpg') }}');
        }
    }

    .objective-item {
        transition: all 0.3s ease;
    }

    .objective-item:hover {
        transform: scale(1.07) translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
</style>


<x-guest-layout>
    <x-slot name="header">
            {{ __('Welcome') }}
    </x-slot>
    <section class="relative text-center py-16 text-white bg-cover bg-center transition-background">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-800/70 to-indigo-900/70 z-0"></div>
        <div class="relative z-10 px-4 justify-center flex flex-col items-center" data-aos="fade-up">
            <img src="{{ asset('images/UTAR_Logo.jpg') }}" class="w-48 h-24 mx-auto mb-6" alt="UTAR Logo">
            <h1 class="text-5xl font-extrabold mb-4" >Welcome to UTAR Facility Rental</h1>
            <p class="text-xl mb-6">Easy, Fast, and Smart Booking System</p>
            <p class="text-lg">From lecture halls and seminar rooms to audio-visual equipment, projectors, labs, sports courts, and even tools for technical work</p>
            <p class="text-lg mb-4"> UTAR's Facility Rental System makes it simple and quick to reserve what you need.</p>
            <div class="space-x-4 flex justify-center">
                <x-button class="px-6 py-2 bg-white text-blue-600 font-semibold rounded hover:bg-blue-100 transition">
                    <a href="{{ route('login') }}">Login</a>
                </x-button>
                <x-button class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-gray-700 transition">
                    <a href="{{ route('register') }}">Register</a>
                </x-button>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white" id="features">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-black mb-8" data-aos="fade-down">Why Use This Platform?</h2>
            <p class="text-lg mb-12 text-gray-700" data-aos="fade-down">Our platform is designed to streamline the facility reservation process for students, faculty, and staff at UTAR. Whether you're organizing an event, hosting a study group, or scheduling a lecture, we provide a seamless experience with our intelligent booking system.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up">
                    <div class="text-blue-600 text-4xl mb-4">⚡</div>
                    <h3 class="font-semibold text-xl mb-2">Fast Bookings</h3>
                    <p>Book your room in just a few clicks. Our simple, user-friendly interface ensures a fast and efficient process.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-blue-600 text-4xl mb-4">🧭</div>
                    <h3 class="font-semibold text-xl mb-2">Real-time Availability</h3>
                    <p>Instantly view available rooms without manual checks or delays in booking approval.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-blue-600 text-4xl mb-4">📅</div>
                    <h3 class="font-semibold text-xl mb-2">Smart Scheduling</h3>
                    <p>Receive reminders, sync with calendars, and optimize your time with our intelligent scheduler.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-blue-600 text-4xl mb-4">🔒</div>
                    <h3 class="font-semibold text-xl mb-2">Secure Platform</h3>
                    <p>Data privacy and user security are top priorities, ensuring peace of mind with every booking.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-blue-600 text-4xl mb-4">📈</div>
                    <h3 class="font-semibold text-xl mb-2">Usage Insights</h3>
                    <p>Track your bookings, analyze usage stats, and make smarter planning decisions.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-blue-600 text-4xl mb-4">🤝</div>
                    <h3 class="font-semibold text-xl mb-2">Collaborative Features</h3>
                    <p>Team up with classmates or colleagues, share bookings, and work better together.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-blue-600 text-4xl mb-4">🏫</div>
                    <h3 class="font-semibold text-xl mb-2">Variety of Facilities</h3>
                    <p>Reserve classrooms, labs, meeting rooms, event halls, sports spaces, or even borrow devices like projectors and laptops.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col items-center" data-aos="fade-up" data-aos-delay="500">
                <div class="text-blue-600 text-4xl mb-4">🛠️</div>
                    <h3 class="font-semibold text-xl mb-2">Special Equipment & Tools</h3>
                    <p>Need a DSLR, whiteboard, lab tools, or sound system? Find and request what you need directly through the platform.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20" id="objectives">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-black mb-8" data-aos="fade-down">Our Objectives</h2>
            <p class="text-lg text-gray-700 mb-12" data-aos="fade-down">Our goal is to provide a fully automated and efficient solution to simplify the room reservation process. We aim to remove unnecessary manual tasks and make the entire experience seamless for everyone involved.</p>
            <ul class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-black text-lg">
                <li class="objective-item p-4 rounded-lg bg-white " data-aos="fade-up"><strong>Simplify room reservation for students and staff</strong>, ensuring smooth access to facilities.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Provide live availability and room statuses</strong>, helping users to make informed decisions quickly.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Remove manual paperwork and automate workflows</strong> for increased efficiency.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Avoid double-bookings with intelligent conflict detection</strong>, ensuring a smooth experience for everyone.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Provide a mobile-friendly interface</strong> for easy on-the-go bookings and access.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Offer robust support and assistance</strong> through our dedicated helpdesk, ensuring quick problem resolution.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Ensure data security and privacy</strong> to protect sensitive information about users and bookings.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Allow advanced search filters</strong> to help users find the perfect room for their needs (capacity, equipment, location, etc.).</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Support multi-type reservations</strong> — book not only rooms, but also devices, tools, or equipment individually or together.</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Enable customizable request forms</strong> to capture specific needs (e.g., room layout, number of microphones, etc.).</li>
                <li class="objective-item p-4 rounded-lg bg-white" data-aos="fade-up"><strong>Allow faculty and staff special access</strong> to advanced booking options and administrative tools.</li>
            </ul>
        </div>
    </section>

    <section class="bg-gray-50 py-20" id="usecases">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-black mb-6 text-center" data-aos="fade-down">Example Use Cases</h2>
            <p class="text-lg text-gray-700 mb-12 text-center" data-aos="fade-down">Our platform is designed to serve a variety of use cases, from student study groups to faculty seminars. Here are just a few examples of how you can make the most of the system:</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up">
                    <h3 class="font-semibold text-xl mb-2">🎤 Club Event</h3>
                    <p>Reserve venues for events, workshops, or panel discussions with ease.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-semibold text-xl mb-2">📚 Study Group</h3>
                    <p>Quickly book group study rooms with friends and classmates for effective collaboration.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="font-semibold text-xl mb-2">👨‍🏫 Lecturer Session</h3>
                    <p>Allow lecturers to schedule extra sessions or book consultation spaces efficiently.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="font-semibold text-xl mb-2">🎮 E-sports Meetup</h3>
                    <p>Reserve a tech-enabled room for a gaming tournament or club event with equipment needs.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="font-semibold text-xl mb-2">📽️ Film Screening</h3>
                    <p>Organize movie nights or project screenings in AV-equipped rooms for your society.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="500">
                    <h3 class="font-semibold text-xl mb-2">🏛️ Guest Lecture</h3>
                    <p>Host guest lecturers or panel discussions and manage space for attendees seamlessly.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="600">
                    <h3 class="font-semibold text-xl mb-2">🧪 Lab Session</h3>
                    <p>Book science or computer labs for scheduled experiments, classwork, or research projects.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="700">
                    <h3 class="font-semibold text-xl mb-2">📷 Equipment Rental</h3>
                    <p>Borrow items like DSLR cameras, projectors, laptops, or other AV tools for your assignment or event.</p>
                </div>
                <div class="bg-white shadow-md p-6 rounded-lg hover:scale-105 transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="800">
                    <h3 class="font-semibold text-xl mb-2">🏐 Sports Practice</h3>
                    <p>Reserve indoor or outdoor courts for student clubs, training sessions, or friendly matches.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-700 text-white py-16 text-center bg-cover bg-center" style="background-image: url({{ asset('images/Schedule.jpg') }});" data-aos="fade-up">
        <div class="bg-blue-900/70 py-12 px-4 flex flex-col items-center">
            <h2 class="text-3xl font-bold mb-4" data-aos="fade-down">Start Booking Now!</h2>
            <p data-aos="fade-up">Register today and take control of your room reservations! With our easy-to-use platform, booking has never been more efficient.</p>
            <p data-aos="fade-up">Whether you're organizing a major university event, conducting research, or simply needing a quiet place to study.</p>
            <p class="mb-6" data-aos="fade-up">Our system has the tools and flexibility to support you. Register now to access everything UTAR offers in one place.</p>
            <div class="space-x-4 flex justify-center" data-aos="fade-up">
                <x-button class="px-6 py-2 bg-white text-blue-600 font-semibold rounded hover:bg-blue-100 transition">
                    <a href="{{ route('login') }}">Login</a>
                </x-button>
                <x-button class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-gray-700 transition">
                    <a href="{{ route('register') }}">Register</a>
                </x-button>
            </div>
        </div>
    </section>
</x-guest-layout>
