<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('expenseModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const modal = document.getElementById('expenseModal');
            const openBtn = document.getElementById('openExpenseModalBtn');
            const closeBtn = document.getElementById('closeExpenseModalBtn');

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            openBtn?.addEventListener('click', openModal);
            closeBtn?.addEventListener('click', closeModal);

            // Close when clicking outside content
            modal?.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });




        });
    </script>


    {{-- --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const modal = document.getElementById('categoryModal');
            const openBtn = document.getElementById('openCategoryModalBtn');
            const closeBtn = document.getElementById('closeCategoryModalBtn');

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            openBtn?.addEventListener('click', openModal);
            closeBtn?.addEventListener('click', closeModal);

            modal?.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

        });
    </script>
</body>

</html>
