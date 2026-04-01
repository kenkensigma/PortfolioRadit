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
                    'Tools'    => ['GLB/GLTF', 'Google Fonts', 'Git'],
                ],

                'info' => [
                    'Type'     => 'AR Product Showcase',
                    'Year'     => '2025',
                    'Role'     => 'Frontend Developer',
                    'Duration' => '1 week',
                ],

                'next' => ['slug' => 'oop-web-api', 'title' => 'OOP WEB API'],
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
                    'Tools'    => ['Thunder Client', 'Laravel Eloquent', 'ngrok'],
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
                    'Tools'    => ['Git'],
                ],

                'info' => [
                    'Type'     => 'Product Catalog',
                    'Year'     => '2024',
                    'Role'     => 'Full Stack Developer',
                    'Duration' => '2 weeks',
                ],

                'next' => ['slug' => 'vault-cms', 'title' => 'Vault CMS'],
            ],

            // ─────────────────────────────────────────────────────────
            'vault-cms' => [
                'num'    => '04',
                'slug'   => 'vault-cms',
                'title'  => 'Vault CMS',
                'type'   => 'Content Management System',
                'desc'   => 'A headless CMS with a clean editor experience, media management, versioning, and a powerful REST API.',
                'color'  => '#1a1200',
                'accent' => '#fbbf24',
                'url'    => '',
                'github' => '',

                'overview' => [
                    'Vault CMS is a headless content management system with a focus on developer experience. Content is managed through a clean, minimal editor interface and served to any frontend via a well-documented REST API.',
                    'Key differentiators include full content versioning with rollback, a flexible media library with folder organisation, role-based access control for editorial teams, and a webhook system to notify frontends of content changes.',
                ],

                'images' => [
                    ['src' => 'images/projects/vault-cms/editor.jpg',   'caption' => 'Content Editor'],
                    ['src' => 'images/projects/vault-cms/media.jpg',    'caption' => 'Media Library'],
                    ['src' => 'images/projects/vault-cms/versions.jpg', 'caption' => 'Content Versioning'],
                    ['src' => 'images/projects/vault-cms/api.jpg',      'caption' => 'REST API Explorer'],
                ],

                'features' => [
                    ['title' => 'Headless Architecture', 'desc' => 'Content is fully decoupled from presentation. Serve it to any frontend — web, mobile, or third-party apps — via REST API.'],
                    ['title' => 'Content Versioning',    'desc' => 'Every edit is saved as a version. Roll back to any previous version with a single click, with a full diff view.'],
                    ['title' => 'Media Library',         'desc' => 'Organised media library with folder structure, image optimisation on upload, and S3-compatible storage support.'],
                    ['title' => 'Role-Based Access',     'desc' => 'Fine-grained permissions: Admins, Editors, and Viewers each have different capabilities across content types.'],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Building an efficient content versioning system without bloating the database',
                        'solution'  => 'Stored versions as JSON snapshots with a diff algorithm to only save changes between versions, reducing storage by ~60% compared to full copies.',
                    ],
                    [
                        'challenge' => 'S3 storage compatibility without hard-locking to AWS',
                        'solution'  => 'Used Laravel\'s Filesystem abstraction with a driver interface, allowing the CMS to work with AWS S3, DigitalOcean Spaces, MinIO, or local storage by changing a single config value.',
                    ],
                ],

                'tech' => [
                    'Backend'  => ['Laravel', 'PHP 8.2', 'MySQL'],
                    'Storage'  => ['AWS S3 / S3-compatible', 'Laravel Filesystem'],
                    'API'      => ['REST API', 'Laravel Sanctum'],
                    'Tools'    => ['Redis', 'Laravel Queues', 'Git'],
                ],

                'info' => [
                    'Type'     => 'CMS / SaaS',
                    'Year'     => '2024',
                    'Role'     => 'Full Stack Developer',
                    'Duration' => '5 weeks',
                ],

                'next' => ['slug' => 'imaji-digital', 'title' => 'IMAJI DIGITAL'],
            ],
            'Bible-Bake Website' => [
                'num'    => '05',
                'slug'   => 'bible-bake',
                'title'  => 'Bible-Bake Website',
                'type'   => 'Website',
                'desc'   => 'A modern, responsive website for a baking business with online ordering capabilities.',
                'color'  => '#1a1200',
                'accent' => '#fbbf24',
                'url'    => '',
                'github' => '',

                'overview' => [
                    'Vault CMS is a headless content management system with a focus on developer experience. Content is managed through a clean, minimal editor interface and served to any frontend via a well-documented REST API.',
                    'Key differentiators include full content versioning with rollback, a flexible media library with folder organisation, role-based access control for editorial teams, and a webhook system to notify frontends of content changes.',
                ],

                'images' => [
                    ['src' => 'images/projects/vault-cms/editor.jpg',   'caption' => 'Content Editor'],
                    ['src' => 'images/projects/vault-cms/media.jpg',    'caption' => 'Media Library'],
                    ['src' => 'images/projects/vault-cms/versions.jpg', 'caption' => 'Content Versioning'],
                    ['src' => 'images/projects/vault-cms/api.jpg',      'caption' => 'REST API Explorer'],
                ],

                'features' => [
                    ['title' => 'Headless Architecture', 'desc' => 'Content is fully decoupled from presentation. Serve it to any frontend — web, mobile, or third-party apps — via REST API.'],
                    ['title' => 'Content Versioning',    'desc' => 'Every edit is saved as a version. Roll back to any previous version with a single click, with a full diff view.'],
                    ['title' => 'Media Library',         'desc' => 'Organised media library with folder structure, image optimisation on upload, and S3-compatible storage support.'],
                    ['title' => 'Role-Based Access',     'desc' => 'Fine-grained permissions: Admins, Editors, and Viewers each have different capabilities across content types.'],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Building an efficient content versioning system without bloating the database',
                        'solution'  => 'Stored versions as JSON snapshots with a diff algorithm to only save changes between versions, reducing storage by ~60% compared to full copies.',
                    ],
                    [
                        'challenge' => 'S3 storage compatibility without hard-locking to AWS',
                        'solution'  => 'Used Laravel\'s Filesystem abstraction with a driver interface, allowing the CMS to work with AWS S3, DigitalOcean Spaces, MinIO, or local storage by changing a single config value.',
                    ],
                ],

                'tech' => [
                    'Backend'  => ['Laravel', 'PHP 8.2', 'MySQL'],
                    'Storage'  => ['AWS S3 / S3-compatible', 'Laravel Filesystem'],
                    'API'      => ['REST API', 'Laravel Sanctum'],
                    'Tools'    => ['Redis', 'Laravel Queues', 'Git'],
                ],

                'info' => [
                    'Type'     => 'CMS / SaaS',
                    'Year'     => '2024',
                    'Role'     => 'Full Stack Developer',
                    'Duration' => '5 weeks',
                ],

                'next' => ['slug' => 'imaji-digital', 'title' => 'IMAJI DIGITAL'],
            ],
            'House of Burger Website' => [
                'num'    => '06',
                'slug'   => 'house-of-burger',
                'title'  => 'House of Burger Website',
                'type'   => 'Website',
                'desc'   => 'A modern, responsive website for a burger restaurant with online ordering capabilities.',
                'color'  => '#1a1200',
                'accent' => '#fbbf24',
                'url'    => '',
                'github' => '',

                'overview' => [
                    'Vault CMS is a headless content management system with a focus on developer experience. Content is managed through a clean, minimal editor interface and served to any frontend via a well-documented REST API.',
                    'Key differentiators include full content versioning with rollback, a flexible media library with folder organisation, role-based access control for editorial teams, and a webhook system to notify frontends of content changes.',
                ],

                'images' => [
                    ['src' => 'images/projects/vault-cms/editor.jpg',   'caption' => 'Content Editor'],
                    ['src' => 'images/projects/vault-cms/media.jpg',    'caption' => 'Media Library'],
                    ['src' => 'images/projects/vault-cms/versions.jpg', 'caption' => 'Content Versioning'],
                    ['src' => 'images/projects/vault-cms/api.jpg',      'caption' => 'REST API Explorer'],
                ],

                'features' => [
                    ['title' => 'Headless Architecture', 'desc' => 'Content is fully decoupled from presentation. Serve it to any frontend — web, mobile, or third-party apps — via REST API.'],
                    ['title' => 'Content Versioning',    'desc' => 'Every edit is saved as a version. Roll back to any previous version with a single click, with a full diff view.'],
                    ['title' => 'Media Library',         'desc' => 'Organised media library with folder structure, image optimisation on upload, and S3-compatible storage support.'],
                    ['title' => 'Role-Based Access',     'desc' => 'Fine-grained permissions: Admins, Editors, and Viewers each have different capabilities across content types.'],
                ],

                'challenges' => [
                    [
                        'challenge' => 'Building an efficient content versioning system without bloating the database',
                        'solution'  => 'Stored versions as JSON snapshots with a diff algorithm to only save changes between versions, reducing storage by ~60% compared to full copies.',
                    ],
                    [
                        'challenge' => 'S3 storage compatibility without hard-locking to AWS',
                        'solution'  => 'Used Laravel\'s Filesystem abstraction with a driver interface, allowing the CMS to work with AWS S3, DigitalOcean Spaces, MinIO, or local storage by changing a single config value.',
                    ],
                ],

                'tech' => [
                    'Backend'  => ['Laravel', 'PHP 8.2', 'MySQL'],
                    'Storage'  => ['AWS S3 / S3-compatible', 'Laravel Filesystem'],
                    'API'      => ['REST API', 'Laravel Sanctum'],
                    'Tools'    => ['Redis', 'Laravel Queues', 'Git'],
                ],

                'info' => [
                    'Type'     => 'CMS / SaaS',
                    'Year'     => '2024',
                    'Role'     => 'Full Stack Developer',
                    'Duration' => '5 weeks',
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
