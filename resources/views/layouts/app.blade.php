<!DOCTYPE html>
<html class="h-full bg-gray-900">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tasks - Todo List</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Toastr -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
      };
    </script>

    <style>
      .animate-fadeIn {
        animation: fadeIn 0.8s ease-in;
      }
      @keyframes fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }
      .animate-modal {
        animation: modalIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      }
      @keyframes modalIn {
        from {
          transform: scale(0.95);
          opacity: 0;
        }
        to {
          transform: scale(1);
          opacity: 1;
        }
      }
    </style>
  </head>
     <!-- Toastr -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <script>
         toastr.options = {
             closeButton: false,
             debug: false,
             newestOnTop: false,
             progressBar: false,
             positionClass: "toast-top-right",
             preventDuplicates: false,
             onclick: null,
             showDuration: "300",
             hideDuration: "1000",
             timeOut: "5000",
             extendedTimeOut: "1000",
             showEasing: "swing",
             hideEasing: "linear",
             showMethod: "fadeIn",
             hideMethod: "fadeOut",
         };
     </script>

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])

     <style>
         .animate-fadeIn {
             animation: fadeIn 0.8s ease-in;
         }

         @keyframes fadeIn {
             from {
                 opacity: 0;
             }

             to {
                 opacity: 1;
             }
         }

         .animate-modal {
             animation: modalIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
         }

         @keyframes modalIn {
             from {
                 transform: scale(0.95);
                 opacity: 0;
             }

             to {
                 transform: scale(1);
                 opacity: 1;
             }
         }
     </style>
 </head>

 <body class="font-sans antialiased">
     {{-- @include('layouts.toastr-notification') --}}
     <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
         @include('layouts.navigation')

         <!-- Page Heading -->
         @isset($header)
             <header class="bg-white dark:bg-gray-800 shadow">
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

     <script>
         // Modal utility functions
         function openModal(modalId) {
             const modal = document.getElementById(modalId);
             if (modal) modal.classList.remove("hidden");
         }

         function closeModal(modalId) {
             const modal = document.getElementById(modalId);
             if (modal) modal.classList.add("hidden");
         }
     </script>
 </body>

 </html>
