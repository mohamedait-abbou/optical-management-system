<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>OptiCRM Pro | Patient Management</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Geist:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-primary-fixed-variant": "#2d476f",
                    "inverse-primary": "#adc7f7",
                    "on-secondary-fixed-variant": "#00497e",
                    "inverse-surface": "#2d3133",
                    "secondary-fixed-dim": "#9fcaff",
                    "on-tertiary": "#ffffff",
                    "surface-dim": "#d7dadc",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-low": "#f1f4f6",
                    "error-container": "#ffdad6",
                    "surface-container-high": "#e5e9eb",
                    "surface-variant": "#e0e3e5",
                    "on-primary-fixed": "#001b3c",
                    "surface": "#f7fafc",
                    "outline": "#74777f",
                    "error": "#ba1a1a",
                    "surface-container-highest": "#e0e3e5",
                    "on-primary": "#ffffff",
                    "tertiary-container": "#003f21",
                    "primary-container": "#1a365d",
                    "secondary-container": "#66affe",
                    "on-tertiary-fixed": "#00210f",
                    "surface-tint": "#455f88",
                    "on-tertiary-container": "#3fb371",
                    "tertiary-fixed-dim": "#6bdc96",
                    "surface-container": "#ebeef0",
                    "secondary-fixed": "#d2e4ff",
                    "on-surface": "#181c1e",
                    "primary": "#002045",
                    "on-secondary-fixed": "#001d37",
                    "on-surface-variant": "#43474e",
                    "on-secondary": "#ffffff",
                    "outline-variant": "#c4c6cf",
                    "primary-fixed": "#d6e3ff",
                    "on-secondary-container": "#004172",
                    "secondary": "#0061a5",
                    "surface-bright": "#f7fafc",
                    "on-tertiary-fixed-variant": "#00522c",
                    "on-primary-container": "#86a0cd",
                    "tertiary": "#002712",
                    "background": "#f7fafc",
                    "tertiary-fixed": "#88f9b0",
                    "on-background": "#181c1e",
                    "inverse-on-surface": "#eef1f3",
                    "on-error": "#ffffff",
                    "on-error-container": "#93000a",
                    "primary-fixed-dim": "#adc7f7"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "spacing": {
                    "sm": "8px",
                    "base": "4px",
                    "md": "16px",
                    "xs": "4px",
                    "lg": "24px",
                    "xl": "32px",
                    "gutter": "20px",
                    "margin-page": "40px"
            },
            "fontFamily": {
                    "headline-md": ["Inter"],
                    "body-md": ["Inter"],
                    "headline-lg": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "body-lg": ["Inter"],
                    "headline-sm": ["Inter"],
                    "data-mono": ["Geist"],
                    "label-md": ["Inter"],
                    "body-sm": ["Inter"]
            },
            "fontSize": {
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                    "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "data-mono": ["14px", {"lineHeight": "20px", "fontWeight": "500"}],
                    "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "body-sm": ["12px", {"lineHeight": "16px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .clinical-shadow {
            box-shadow: 0 10px 15px -3px rgba(26, 54, 93, 0.05);
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f7fafc;
        }
        ::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
</head>
<body class="bg-surface font-body-md text-on-surface">
<!-- Shell Layout -->
<div class="flex min-h-screen">
<!-- SideNavBar Component -->
<aside class="fixed left-0 top-0 h-full w-[260px] flex flex-col py-md px-sm border-r border-outline-variant bg-surface z-50">
<div class="px-md mb-xl flex items-center gap-sm">
<div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-inverse-primary" style="font-variation-settings: 'FILL' 1;">visibility</span>
</div>
<div>
<h1 class="font-headline-sm text-headline-sm font-bold text-primary">OptiCRM Pro</h1>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Medical Tech Suite</p>
</div>
</div>
<nav class="flex-1 space-y-base">
<!-- Dashboard -->
<a class="flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all group" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<!-- Patients (ACTIVE) -->
<a class="flex items-center gap-md px-md py-sm rounded-lg text-primary font-bold border-r-4 border-primary bg-primary-fixed/10 scale-[0.98] transition-transform duration-150" href="#">
<span class="material-symbols-outlined" data-icon="group" style="font-variation-settings: 'FILL' 1;">group</span>
<span class="font-label-md text-label-md">Patients</span>
</a>
<!-- Appointments -->
<a class="flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all" href="#">
<span class="material-symbols-outlined" data-icon="calendar_today">calendar_today</span>
<span class="font-label-md text-label-md">Appointments</span>
</a>
<!-- Inventory -->
<a class="flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all" href="#">
<span class="material-symbols-outlined" data-icon="inventory_2">inventory_2</span>
<span class="font-label-md text-label-md">Inventory</span>
</a>
<!-- Billing -->
<a class="flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all" href="#">
<span class="material-symbols-outlined" data-icon="payments">payments</span>
<span class="font-label-md text-label-md">Billing</span>
</a>
</nav>
<div class="mt-auto pt-md border-t border-outline-variant space-y-base">
<a class="flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-label-md text-label-md">Settings</span>
</a>
<a class="flex items-center gap-md px-md py-sm rounded-lg text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all" href="#">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
<span class="font-label-md text-label-md">Support</span>
</a>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="flex-1 ml-[260px] min-h-screen flex flex-col">
<!-- TopNavBar Component -->
<header class="flex justify-between items-center h-16 w-full px-lg sticky top-0 z-40 bg-surface/80 backdrop-blur-md border-b border-outline-variant">
<div class="flex items-center gap-xl w-1/2">
<div class="relative w-full max-w-md group">
<span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
<input class="w-full bg-surface-container-low border border-outline-variant rounded-full py-2 pl-12 pr-md font-body-md focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Patient Search (Cmd + K)" type="text"/>
<div class="absolute right-md top-1/2 -translate-y-1/2 hidden md:block">
<span class="text-[10px] font-bold text-outline border border-outline-variant rounded px-1.5 py-0.5">⌘ K</span>
</div>
</div>
</div>
<div class="flex items-center gap-md">
<button class="w-10 h-10 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-low transition-all relative">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-low transition-all">
<span class="material-symbols-outlined" data-icon="help">help</span>
</button>
<div class="h-8 w-[1px] bg-outline-variant mx-xs"></div>
<div class="flex items-center gap-sm">
<div class="text-right">
<p class="font-label-md text-label-md text-primary">Dr. Practitioner</p>
<p class="text-[10px] text-on-surface-variant">Lead Optometrist</p>
</div>
<img class="w-10 h-10 rounded-full border border-primary-container object-cover" data-alt="A professional studio portrait of a friendly middle-aged male doctor with glasses, wearing a crisp white clinical coat against a clean, soft blue background. The lighting is bright and professional, conveying trust and medical expertise in a modern corporate health environment." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBETeqHDXmZ2FOQPdgWNQ5E3TNqCHvd14QtdYO0Y41DaOLsvl-iEM7jkYGkwUkIjid3Rpfjcg-Pgj_DOMOPjXRUKRDcRDGUsQph610k6UGLmO2ODGCjfwdDy8emtExrt-Lw1WRja9NrtwsY3FX_YKqAsPTS8qHmnSpvWYtKSlAnmKYN-JmjVW3GSFBlXeOGGCzWmZybe9F_udU5G5KUVox_BhbD9XpS7-2YH_R4Bl4GCQ5pgeVf7F0gHBqX_KfjVx10GqO5oUgpPHn0"/>
</div>
</div>
</header>
<!-- Page Content -->
<div class="p-lg flex-1">
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-md mb-xl">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-xs">Patient Management</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Maintain and manage clinical records for 1,248 active patients.</p>
</div>
<button class="bg-primary text-on-primary font-label-md text-label-md px-lg py-md rounded-lg flex items-center gap-sm hover:opacity-90 transition-opacity clinical-shadow">
<span class="material-symbols-outlined" data-icon="person_add">person_add</span>
                        ADD NEW PATIENT
                    </button>
</div>
<!-- Bento Style Stats (Mini) -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-md mb-xl">
<div class="bg-surface border border-outline-variant p-md rounded-xl clinical-shadow">
<p class="text-on-surface-variant font-label-md text-label-md uppercase mb-base">Total Patients</p>
<p class="text-headline-md font-headline-md text-primary">1,248</p>
<div class="mt-sm flex items-center gap-xs text-[12px] text-on-tertiary-container">
<span class="material-symbols-outlined text-[16px]" data-icon="trending_up">trending_up</span>
<span>12% this month</span>
</div>
</div>
<div class="bg-surface border border-outline-variant p-md rounded-xl clinical-shadow">
<p class="text-on-surface-variant font-label-md text-label-md uppercase mb-base">Due for Exam</p>
<p class="text-headline-md font-headline-md text-secondary">86</p>
<div class="mt-sm flex items-center gap-xs text-[12px] text-on-surface-variant">
<span class="material-symbols-outlined text-[16px]" data-icon="schedule">schedule</span>
<span>Requires action</span>
</div>
</div>
<div class="bg-surface border border-outline-variant p-md rounded-xl clinical-shadow">
<p class="text-on-surface-variant font-label-md text-label-md uppercase mb-base">Today's Visits</p>
<p class="text-headline-md font-headline-md text-on-tertiary-container">14</p>
<div class="mt-sm flex items-center gap-xs text-[12px] text-on-tertiary-container">
<span class="material-symbols-outlined text-[16px]" data-icon="check_circle">check_circle</span>
<span>8 completed</span>
</div>
</div>
<div class="bg-surface border border-outline-variant p-md rounded-xl clinical-shadow">
<p class="text-on-surface-variant font-label-md text-label-md uppercase mb-base">New Files</p>
<p class="text-headline-md font-headline-md text-primary-container">32</p>
<div class="mt-sm flex items-center gap-xs text-[12px] text-on-surface-variant">
<span class="material-symbols-outlined text-[16px]" data-icon="calendar_today">calendar_today</span>
<span>Last 7 days</span>
</div>
</div>
</div>
<!-- Table & Filters Container -->
<div class="bg-surface border border-outline-variant rounded-xl overflow-hidden clinical-shadow">
<!-- Search and Filter Bar -->
<div class="p-md border-b border-outline-variant flex flex-col md:flex-row gap-md items-center justify-between bg-surface-container-lowest">
<div class="flex items-center gap-sm w-full md:w-auto">
<div class="relative w-full md:w-80">
<span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline-variant" data-icon="search">search</span>
<input class="w-full pl-xl pr-md py-sm border border-outline-variant rounded-lg text-body-md focus:ring-1 focus:ring-primary outline-none" placeholder="Filter by name..." type="text"/>
</div>
<button class="p-sm border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors text-on-surface-variant flex items-center gap-xs">
<span class="material-symbols-outlined" data-icon="filter_list">filter_list</span>
<span class="font-label-md text-label-md">Filters</span>
</button>
</div>
<div class="flex items-center gap-sm w-full md:w-auto overflow-x-auto pb-xs md:pb-0">
<span class="font-label-md text-label-md text-on-surface-variant whitespace-nowrap">Status:</span>
<div class="flex gap-xs">
<button class="px-md py-xs rounded-full bg-primary-fixed text-primary font-label-md text-[11px] whitespace-nowrap">All</button>
<button class="px-md py-xs rounded-full border border-outline-variant text-on-surface-variant font-label-md text-[11px] hover:bg-surface-container-low whitespace-nowrap">Active</button>
<button class="px-md py-xs rounded-full border border-outline-variant text-on-surface-variant font-label-md text-[11px] hover:bg-surface-container-low whitespace-nowrap">Due for Exam</button>
</div>
</div>
</div>
<!-- Patient Data Table -->
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant">
<th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Patient Name</th>
<th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Last Exam Date</th>
<th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Next Appointment</th>
<th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
<th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Primary Doctor</th>
<th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
<!-- Row 1: Active -->
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold">JD</div>
<div>
<p class="font-body-lg text-primary font-semibold">Jonathan Doe</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">#P-98421</p>
</div>
</div>
</td>
<td class="px-lg py-md font-data-mono text-data-mono text-on-surface">Oct 12, 2023</td>
<td class="px-lg py-md font-data-mono text-data-mono text-on-surface">Nov 22, 2024</td>
<td class="px-lg py-md">
<span class="inline-flex items-center px-sm py-1 rounded-full bg-tertiary-fixed/30 text-on-tertiary-fixed-variant font-label-md text-[10px]">
<span class="w-1.5 h-1.5 rounded-full bg-on-tertiary-container mr-1.5"></span>
                                            Active
                                        </span>
</td>
<td class="px-lg py-md text-body-md">Dr. Practitioner</td>
<td class="px-lg py-md text-right">
<div class="flex items-center justify-end gap-sm opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="visibility">visibility</span></button>
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="edit">edit</span></button>
<button class="p-sm text-on-surface-variant hover:text-error"><span class="material-symbols-outlined" data-icon="more_vert">more_vert</span></button>
</div>
</td>
</tr>
<!-- Row 2: Due for Exam -->
<tr class="bg-surface-container-low/30 hover:bg-surface-container-low transition-colors group border-l-4 border-secondary">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary font-bold">EW</div>
<div>
<p class="font-body-lg text-primary font-semibold">Emma Wilson</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">#P-98553</p>
</div>
</div>
</td>
<td class="px-lg py-md font-data-mono text-data-mono text-on-surface">Mar 05, 2022</td>
<td class="px-lg py-md font-data-mono text-data-mono text-error">EXPIRED</td>
<td class="px-lg py-md">
<span class="inline-flex items-center px-sm py-1 rounded-full bg-secondary-fixed text-on-secondary-container font-label-md text-[10px]">
<span class="w-1.5 h-1.5 rounded-full bg-secondary mr-1.5 animate-pulse"></span>
                                            Due for Exam
                                        </span>
</td>
<td class="px-lg py-md text-body-md">Dr. Practitioner</td>
<td class="px-lg py-md text-right">
<div class="flex items-center justify-end gap-sm opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="visibility">visibility</span></button>
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="calendar_add_on">calendar_add_on</span></button>
<button class="p-sm text-on-surface-variant hover:text-error"><span class="material-symbols-outlined" data-icon="more_vert">more_vert</span></button>
</div>
</td>
</tr>
<!-- Row 3: Inactive -->
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center text-on-surface-variant font-bold">MB</div>
<div>
<p class="font-body-lg text-primary font-semibold">Marcus Brown</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">#P-81200</p>
</div>
</div>
</td>
<td class="px-lg py-md font-data-mono text-data-mono text-outline">Jan 10, 2021</td>
<td class="px-lg py-md font-data-mono text-data-mono text-on-surface">—</td>
<td class="px-lg py-md">
<span class="inline-flex items-center px-sm py-1 rounded-full bg-surface-variant text-on-surface-variant font-label-md text-[10px]">
<span class="w-1.5 h-1.5 rounded-full bg-outline mr-1.5"></span>
                                            Inactive
                                        </span>
</td>
<td class="px-lg py-md text-body-md">Dr. Specialist</td>
<td class="px-lg py-md text-right">
<div class="flex items-center justify-end gap-sm opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="visibility">visibility</span></button>
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="settings_backup_restore">settings_backup_restore</span></button>
<button class="p-sm text-on-surface-variant hover:text-error"><span class="material-symbols-outlined" data-icon="more_vert">more_vert</span></button>
</div>
</td>
</tr>
<!-- Row 4: Active -->
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold">SL</div>
<div>
<p class="font-body-lg text-primary font-semibold">Sarah Lee</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">#P-99102</p>
</div>
</div>
</td>
<td class="px-lg py-md font-data-mono text-data-mono text-on-surface">Aug 30, 2024</td>
<td class="px-lg py-md font-data-mono text-data-mono text-on-surface">Oct 12, 2024</td>
<td class="px-lg py-md">
<span class="inline-flex items-center px-sm py-1 rounded-full bg-tertiary-fixed/30 text-on-tertiary-fixed-variant font-label-md text-[10px]">
<span class="w-1.5 h-1.5 rounded-full bg-on-tertiary-container mr-1.5"></span>
                                            Active
                                        </span>
</td>
<td class="px-lg py-md text-body-md">Dr. Practitioner</td>
<td class="px-lg py-md text-right">
<div class="flex items-center justify-end gap-sm opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="visibility">visibility</span></button>
<button class="p-sm text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined" data-icon="edit">edit</span></button>
<button class="p-sm text-on-surface-variant hover:text-error"><span class="material-symbols-outlined" data-icon="more_vert">more_vert</span></button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-lg py-md bg-surface border-t border-outline-variant flex items-center justify-between">
<p class="font-body-sm text-body-sm text-on-surface-variant">Showing <span class="font-bold text-on-surface">1 - 25</span> of 1,248 patients</p>
<div class="flex items-center gap-sm">
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low disabled:opacity-30" disabled="">
<span class="material-symbols-outlined text-[18px]" data-icon="chevron_left">chevron_left</span>
</button>
<div class="flex gap-xs">
<button class="w-8 h-8 flex items-center justify-center rounded bg-primary text-on-primary font-label-md text-[12px]">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low font-label-md text-[12px]">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low font-label-md text-[12px]">3</button>
</div>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low">
<span class="material-symbols-outlined text-[18px]" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
<!-- Footer Area -->
<footer class="mt-auto px-lg py-md border-t border-outline-variant text-on-surface-variant flex justify-between items-center bg-surface-container-lowest">
<p class="text-[10px] font-label-md uppercase tracking-widest">© 2024 OptiCRM Pro Medical Tech Suite v4.2</p>
<div class="flex gap-md text-[10px] font-label-md uppercase tracking-widest">
<a class="hover:text-primary" href="#">HIPAA Compliance</a>
<a class="hover:text-primary" href="#">Data Export</a>
<a class="hover:text-primary" href="#">Audit Log</a>
</div>
</footer>
</main>
</div>
<!-- Micro-interaction Scripts -->
<script>
        document.addEventListener('keydown', (e) => {
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                document.querySelector('input[type="text"]').focus();
            }
        });

        // Simple row highlight effect on table hover (optional JS if extra flair is needed)
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                // Future implementation for navigation to patient details
                console.log('Navigating to patient record...');
            });
        });
    </script>
</body></html>