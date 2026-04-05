<?php

namespace App\Data;

class ProjectsData
{
    /**
     * All projects data.
     * To add a new project — just add a new entry to this array.
     *
     * images[]:  put your screenshots in public/images/projects/{slug}/
     * tech[]:    grouped by category (Frontend, Backend, Database, etc.)
     * info[]:    key-value pairs shown in the sidebar
     * features[]: highlight cards with title + desc
     * challenges[]: problem/solution pairs
     * next[]:    slug + title of the next project for navigation
     */
    public static function all(): array
    {
        return [

            'imaji-digital' => [
                'num'    => '01',
                'slug'   => 'imaji-digital',
                'title'  => 'IMAJI DIGITAL',
                'type'   => 'AR Product Showcase — UMKM',
                'desc'   => 'A mobile-first AR product showcase for Indonesian UMKM, allowing customers to view products in 3D and AR directly from their browser by scanning a QR code — no app installation required.',
                'color'  => '#050a0e',
                'accent' => '#22c55e',
                'url'    => 'https://imaji-digital.vercel.app/',
                'github' => 'https://github.com/kenkensigma/IMAJI-DIGITAL',

                'overview' => [
                    'IMAJI DIGITAL is a mobile-first AR product showcase platform built for Indonesian UMKM (small and medium enterprises). Customers scan a QR code and are instantly taken to a webpage where they can interact with 3D product models or view them in Augmented Reality — directly in their browser, with zero app installation.',
                    'The platform addresses a key problem in online UMKM sales: buyers struggle to visualize product size and fit before purchasing. By combining Google Model Viewer with WebXR and Scene Viewer, the site delivers a seamless 3D/AR experience on both Android and iOS devices.',
                ],

                'images' => [
                    ['src' => 'images/projects/imaji-digital/hero.png',     'caption' => 'Hero Section & 3D Model Viewer'],
                    ['src' => 'images/projects/imaji-digital/about.png',    'caption' => 'About — SCAN Integration Flow'],
                    ['src' => 'images/projects/imaji-digital/demo.jpeg',     'caption' => 'Product Demo — 3D & AR View'],
                    ['src' => 'images/projects/imaji-digital/contact.png',  'caption' => 'Contact & WhatsApp CTA'],
                ],

                'features' => [
                    ['title' => 'AR Mode',           'desc' => 'Browser-based Augmented Reality using Google Model Viewer with WebXR (Android) and Quick Look (iOS) — no app download required. Customers point their camera to place products in their real space.'],
                    ['title' => '3D Model Viewer',   'desc' => 'Interactive 3D viewer with rotation, zoom, and auto-rotate. Powered by Google Model Viewer with GLB model support.'],
                    ['title' => 'QR Code Flow',      'desc' => 'Customers scan a QR code and land directly on the product page — instant 3D/AR access with no friction or installation.'],
                    ['title' => 'Scroll Animations', 'desc' => 'Smooth fade-up reveal animations triggered by scroll position using IntersectionObserver API.'],
                ],

                'challenges' => [
                    [
                        'challenge' => 'AR compatibility across different Android devices',
                        'solution'  => 'Implemented canActivateAR detection to gracefully show a warning message on unsupported devices, while ensuring the 3D viewer always works as a fallback for all users.',
                    ],
                    [
                        'challenge' => 'iOS AR support without a USDZ file',
                        'solution'  => 'Scoped ar-modes to webxr and scene-viewer only, removing quick-look for iOS since only GLB assets were available. Documented the USDZ conversion path for future implementation.',
                    ],
                ],

                'tech' => [
                    'Backend'  => ['None (Static Site)'],
                    'Frontend' => ['HTML5', 'CSS3', 'Vanilla JavaScript', 'Google Model Viewer'],
                    'Tools'    => ['GLB/GLTF', 'Google Fonts', 'Git', 'VS Code'],
                ],

                'info' => [
                    'Type'     => 'AR Product Showcase',
                    'Year'     => '2025',
                    'Role'     => 'Frontend Developer',
                    'Duration' => '1 week',
                ],

                'next' => ['slug' => 'oop-school', 'title' => 'OOP School'],
            ],

            // ─────────────────────────────────────────────────────────
            'oop-school' => [
                'num'    => '02',
                'slug'   => 'oop-school',
                'title'  => 'OOP School',
                'type'   => 'Learning Platform',
                'desc'   => 'A REST API backend for an OOP learning platform with course management, lesson progression, exercise evaluation, and a gamified unlock system.',
                'color'  => '#080B10',
                'accent' => '#60A5FA',
                'url'    => '',
                'github' => '',

                'overview' => [
                    'OOP School is a learning platform backend built with Laravel 12, providing a structured REST API for managing OOP courses, lessons, and exercises.',
                    'The system features token-based authentication via Laravel Sanctum, role-based access control for Student, Teacher, and Admin, a gamified course unlock system triggered by lesson completion, and server-side exercise evaluation.',
                ],

                'images' => [
                    ['src' => 'images/projects/oop-school/api-docs.png',   'caption' => 'API Endpoints Overview'],
                    ['src' => 'images/projects/oop-school/postman.png',    'caption' => 'Postman Collection'],
                    ['src' => 'images/projects/oop-school/database.png',   'caption' => 'Database Schema'],
                    ['src' => 'images/projects/oop-school/sanctum.png',    'caption' => 'Sanctum Auth Flow'],
                ],

                'features' => [
                    ['title' => 'Sanctum Auth',       'desc' => 'Token-based authentication with register, login, and logout for 3 roles — Student, Teacher, and Admin. Each role has separate endpoints and middleware protection.'],
                    ['title' => 'Role-Based Access',  'desc' => 'Three roles: Student, Teacher, and Admin. Each has dedicated middleware (EnsureRole) restricting access to their own endpoints only.'],
                    ['title' => 'Teacher Approval',   'desc' => 'Teachers register with pending status and cannot login until approved or rejected by an admin via dedicated admin endpoints.'],
                    ['title' => 'Course Management',  'desc' => 'CRUD for courses with unlock logic — a course is only accessible once the previous one is fully completed.'],
                    ['title' => 'Lesson Tracking',    'desc' => 'Per-user lesson completion tracking. Each lesson can be marked complete, updating course progress automatically.'],
                    ['title' => 'Exercise Engine',    'desc' => 'Server-side exercise evaluation endpoint that checks submitted answers and returns pass/fail with feedback.'],
                    ['title' => 'Unlock System',      'desc' => 'Automatically unlocks the next course when all lessons in the current course are marked complete by the user.'],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Tracking lesson completion per user without polluting the lessons table',
                        'solution'  => 'Used a pivot table between users and lessons to store completion status, keeping the lessons table clean and reusable across all users.',
                    ],
                    [
                        'challenge' => 'Automatically unlocking the next course when a course is completed',
                        'solution'  => 'After every lesson completion, a check runs to see if all lessons in the course are done. If so, the next course entry is unlocked for that user via a user_course pivot.',
                    ],
                ],

                'tech' => [
                    'Backend'  => ['Laravel 12', 'PHP 8.2', 'MySQL'],
                    'Auth'     => ['Laravel Sanctum'],
                    'Tools'    => ['Thunder Client', 'Laravel Eloquent', 'ngrok', 'VS Code'],
                ],

                'info' => [
                    'Type'     => 'REST API',
                    'Year'     => '2025',
                    'Role'     => 'Backend Developer',
                    'Duration' => '1 week',
                ],

                'next' => ['slug' => 'noja-garage', 'title' => 'Noja Garage'],
            ],

            // ─────────────────────────────────────────────────────────
            'noja-garage' => [
                'num'    => '03',
                'slug'   => 'noja-garage',
                'title'  => 'Noja Garage',
                'type'   => 'Product Catalog Website',
                'desc'   => 'A Laravel-based car promotional website with MySQL database, TailwindCSS frontend, and simple admin dashboard for managing car listings.',
                'color'  => '#0a1a0f',
                'accent' => '#4ade80',
                'url'    => '',
                'github' => '',

                'overview' => [
                    'Noja Garage is a car promotional and catalog website built for an automotive business. It features a clean, browsable inventory of car listings with filtering by brand, year, and price range.',
                    'The project includes a custom admin dashboard where staff can add, edit, and delete car listings, upload multiple photos per car, and manage inquiries from potential buyers submitted through the contact form.',
                ],

                'images' => [
                    ['src' => 'images/projects/noja-garage/home.png',     'caption' => 'Homepage — Car Catalog'],
                    ['src' => 'images/projects/noja-garage/listing.png',  'caption' => 'Car Listing Detail Page'],
                    ['src' => 'images/projects/noja-garage/detail.png',   'caption' => 'Detail Page with Photo Gallery'],
                    ['src' => 'images/projects/noja-garage/dashboard.png',    'caption' => 'Admin Dashboard'],
                ],

                'features' => [
                    ['title' => 'Car Catalog',      'desc' => 'Browsable inventory with filtering by brand, year, price range, and condition (new/used).'],
                    ['title' => 'Photo Gallery',    'desc' => 'Each car listing supports multiple photos with a lightbox viewer and thumbnail navigation.'],
                    ['title' => 'Admin Dashboard',  'desc' => 'Simple CRUD admin panel for managing car listings, photo uploads, and buyer inquiries.'],
                    ['title' => 'Inquiry System',   'desc' => 'Contact form on each listing that sends email notifications to the business owner with the buyer\'s details.'],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Handling multiple image uploads efficiently',
                        'solution'  => 'Used Laravel\'s filesystem with local storage and implemented image resizing with Laravel Intervention Image to generate thumbnails automatically on upload.',
                    ],
                ],

                'tech' => [
                    'Backend'  => ['Laravel', 'PHP 8.2', 'MySQL', 'Javascript'],
                    'Frontend' => ['CSS', 'HTML5', 'Blade'],
                    'Storage'  => ['Laravel Storage'],
                    'Tools'    => ['Git', 'VS Code'],
                ],

                'info' => [
                    'Type'     => 'Product Catalog',
                    'Year'     => '2024',
                    'Role'     => 'Full Stack Developer',
                    'Duration' => '2 weeks',
                ],

                'next' => ['slug' => 'ZBooks', 'title' => 'ZBooks SMK'],
            ],
            // ─────────────────────────────────────────────────────────
            'ZBooks' => [
                'num'    => '04',
                'slug'   => 'ZBooks',
                'title'  => 'ZBooks SMK',
                'type'   => 'Library Management System',
                'desc'   => 'A digital school library application built with Laravel 12, featuring role-based access for Admin and Students, book borrowing & return management, automated fine calculation, and monthly reports.',
                'color'  => '#0f1117',
                'accent' => '#7c6ff7',
                'url'    => '',
                'github' => '',

                'overview' => [
                    'ZBooks SMK is a full-featured digital library management system built with Laravel 12, MySQL, and Bootstrap 5. It serves two user roles — Admin and Student — each with a dedicated dashboard and tailored feature set.',
                    'Key capabilities include a complete book catalog with stock management, a borrowing and return workflow with automated overdue detection and fine calculation, member management, and a monthly report dashboard with an interactive Chart.js graph.',
                ],

                'images' => [
                    ['src' => 'images/projects/zbooks/dashboard-admin.png', 'caption' => 'Admin Dashboard'],
                    ['src' => 'images/projects/zbooks/books.png',           'caption' => 'Book Catalog'],
                    ['src' => 'images/projects/zbooks/transactions.png',    'caption' => 'Transaction Management'],
                    ['src' => 'images/projects/zbooks/report.png',          'caption' => 'Monthly Report'],
                ],

                'features' => [
                    ['title' => 'Role-Based Access Control',    'desc' => 'Separate dashboards and middleware-protected routes for Admin and Student roles. Admins manage all data; students can only view, borrow, and return books.'],
                    ['title' => 'Borrow & Return Workflow',     'desc' => 'Students borrow books online with a 7-day due date. The system prevents duplicate borrowing and automatically marks overdue loans. Returns calculate fines at Rp 1,000/day.'],
                    ['title' => 'Live Stock Management',        'desc' => 'Book stock decrements on borrow and increments on return inside a DB transaction, preventing race conditions and ensuring stock integrity at all times.'],
                    ['title' => 'Reports & Analytics',          'desc' => 'Monthly borrowing reports with a Chart.js bar chart, top-5 most borrowed books, and a full status breakdown — all filterable by year and month.'],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Preventing duplicate active loans for the same book and user',
                        'solution'  => 'Added a query check before every borrow that looks for an existing transaction with status borrowed or overdue for the same user–book pair, returning a clear error message if found.',
                    ],
                    [
                        'challenge' => 'Keeping stock consistent under concurrent borrow requests',
                        'solution'  => 'Wrapped every borrow and return operation in a DB::transaction() block with a stock guard in the Book model\'s decrementStock() method, ensuring stock never drops below zero.',
                    ],
                ],

                'tech' => [
                    'Backend'   => ['Laravel 12', 'PHP 8.2', 'MySQL'],
                    'Frontend'  => ['Blade Templates', 'Bootstrap 5', 'Chart.js'],
                    'Auth'      => ['Laravel Auth', 'Custom Role Middleware'],
                    'Tools'     => ['Eloquent ORM', 'Form Requests', 'DB Transactions', 'Git', 'VS Code'],
                ],

                'info' => [
                    'Type'     => 'Web App / Academic Project',
                    'Year'     => '2025',
                    'Role'     => 'Full Stack Developer',
                    'Duration' => '2 weeks',
                ],

                'next' => ['slug' => 'bible-bake', 'title' => 'bible-bake'],
            ],

            'bible-bake' => [
                'num'    => '05',
                'slug'   => 'bible-bake',
                'title'  => 'Bible-Bake Website',
                'type'   => 'Landing Page / E-Commerce UI',
                'desc'   => 'A modern, aesthetic landing page for a bakery brand featuring interactive UI, animated elements, and a simple shopping cart experience.',
                'color'  => '#1a1200',
                'accent' => '#f472b6',
                'url'    => '',
                'github' => 'https://github.com/Bagusnugraha14/donut-web-client',

                'overview' => [
                    'Bible-Bake is a modern and visually engaging bakery landing page inspired by contemporary dessert brands. The project focuses on delivering an immersive user experience through a combination of aesthetic design, smooth animations, and intuitive interaction patterns. Every section is carefully structured to highlight products in a way that feels both appetising and easy to explore.',

                    'The website features a playful yet clean interface, using soft color palettes, gradients, and micro-interactions to create a lively atmosphere. From the hero section to the product listings, each element is designed to guide users naturally while maintaining visual appeal. The layout prioritises clarity and hierarchy, ensuring that users can quickly understand the content without feeling overwhelmed.',

                    'Beyond visual design, the project also implements interactive functionality such as a dynamic cart system, allowing users to simulate a real shopping experience. This adds depth to the landing page, transforming it from a static showcase into a more functional and engaging interface.',

                    'This project demonstrates strong attention to UI/UX principles, front-end development skills, and the ability to balance creativity with usability. It reflects a practical approach to building modern web interfaces that are not only visually appealing but also responsive and user-friendly across different devices.',
                ],


                'images' => [
                    ['src' => 'images/projects/bible-bake/hero.png',   'caption' => 'Hero Section'],
                    ['src' => 'images/projects/bible-bake/menu.png',   'caption' => 'Product Menu'],
                    ['src' => 'images/projects/bible-bake/reviews.png', 'caption' => 'Customer Reviews'],
                    ['src' => 'images/projects/bible-bake/cart.png',   'caption' => 'Cart Interaction'],
                ],

                'features' => [
                    [
                        'title' => 'Modern Aesthetic UI',
                        'desc'  => 'Designed with a playful and visually appealing style using gradients, soft colors, and smooth animations to enhance user engagement.',
                    ],
                    [
                        'title' => 'Interactive Cart System',
                        'desc'  => 'Users can add items to a cart, adjust quantities, and view total prices dynamically without page reload.',
                    ],
                    [
                        'title' => 'Smooth Animations',
                        'desc'  => 'Includes multiple custom animations such as floating elements, hover effects, and transitions to create a lively browsing experience.',
                    ],
                    [
                        'title' => 'Responsive Design',
                        'desc'  => 'Optimised for both desktop and mobile devices, ensuring consistent layout and usability across screen sizes.',
                    ],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Maintaining performance with many animations and visual effects',
                        'solution'  => 'Optimised CSS animations and limited heavy effects while ensuring smooth transitions across devices.',
                    ],
                    [
                        'challenge' => 'Creating an engaging UI without overwhelming users',
                        'solution'  => 'Balanced playful design with clean layout structure, ensuring readability and usability remain the priority.',
                    ],
                ],

                'tech' => [
                    'Frontend' => ['HTML5', 'CSS3', 'JavaScript'],
                    'Design'   => ['Custom CSS Animations', 'Responsive Layout'],
                    'Tools'    => ['Git', 'VS Code'],
                ],

                'info' => [
                    'Type'     => 'Landing Page',
                    'Year'     => '2026',
                    'Role'     => 'Frontend Developer',
                    'Duration' => '1 week',
                ],

                'next' => ['slug' => 'imaji-digital', 'title' => 'IMAJI DIGITAL'],
            ],

            'house-of-burger' => [
                'num'    => '06',
                'slug'   => 'house-of-burger',
                'title'  => 'House of Burger Website',
                'type'   => 'Website',
                'desc'   => 'A modern and visually appealing burger restaurant website designed to showcase menu items and provide a seamless online ordering experience.',
                'color' => '#100a1a',
                'accent' => '#a78bfa',  
                'url'    => 'https://house-of-burger-seven.vercel.app/',
                'github' => 'https://github.com/kenkensigma/House-of-Burger',

                'overview' => [
                    'House of Burger is a modern restaurant website built to highlight a variety of premium burgers through a clean, bold, and visually engaging interface. The design focuses on strong branding, mouth-watering visuals, and smooth navigation to enhance user engagement.',
                    'The website features an interactive menu section, responsive layout across devices, and a simple ordering flow that allows users to explore products and place orders easily. It is optimized for performance and designed to deliver a fast, user-friendly browsing experience.',
                ],

                'images' => [
                    ['src' => 'images/projects/house-of-burger/hero-burger.png',   'caption' => 'Homepage Hero Section'],
                    ['src' => 'images/projects/house-of-burger/menu-burger.png',   'caption' => 'Burger Menu Display'],
                    ['src' => 'images/projects/house-of-burger/contact-burger.png', 'caption' => 'Contact Section View'],
                    ['src' => 'images/projects/house-of-burger/order.png',  'caption' => 'Ordering Interface'],
                ],

                'features' => [
                    [
                        'title' => 'Modern UI/UX Design',
                        'desc'  => 'Clean and bold interface with strong visual hierarchy, making the website attractive and easy to navigate for users.',
                    ],
                    [
                        'title' => 'Responsive Layout',
                        'desc'  => 'Fully responsive design that works smoothly across desktop, tablet, and mobile devices.',
                    ],
                    [
                        'title' => 'Interactive Menu',
                        'desc'  => 'Dynamic menu section that showcases burger items with images, descriptions, and pricing in an engaging way.',
                    ],
                    [
                        'title' => 'Online Ordering Flow',
                        'desc'  => 'Simple and intuitive ordering experience that allows users to browse and select items quickly.',
                    ],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Creating a visually appealing food layout without sacrificing performance',
                        'solution'  => 'Optimized images and used efficient layout structuring to maintain fast loading times while keeping high-quality visuals.',
                    ],
                    [
                        'challenge' => 'Ensuring consistent design across multiple screen sizes',
                        'solution'  => 'Implemented responsive design techniques using flexible layouts and media queries to ensure consistency on all devices.',
                    ],
                ],

                'tech' => [
                    'Frontend' => ['HTML', 'CSS', 'JavaScript'],
                    'UI'       => ['Custom CSS', 'Responsive Design'],
                    'Tools'    => ['Vercel', 'Git', 'Figma'],
                ],

                'info' => [
                    'Type'     => 'Restaurant Website',
                    'Year'     => '2025',
                    'Role'     => 'Frontend Developer',
                    'Duration' => '1–2 weeks',
                ],

                'next' => ['slug' => 'imaji-digital', 'title' => 'IMAJI DIGITAL'],
            ],


        ];
    }

    /**
     * Get a single project by slug. Returns null if not found.
     */
    public static function find(string $slug): ?array
    {
        return static::all()[$slug] ?? null;
    }
}
