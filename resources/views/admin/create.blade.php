<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Trek - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': 'hsl(215 27.9% 16.9%)',
                        'primary-foreground': 'hsl(0 0% 100%)',
                        'muted': 'hsl(210 40% 96.1%)',
                        'muted-foreground': 'hsl(210 4.6% 76.5%)',
                        'foreground': 'hsl(222.2 47.4% 11.2%)',
                        'background': 'hsl(0 0% 100%)',
                        'destructive': 'hsl(0 84.2% 60.2%)',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'serif': ['Merriweather', 'serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* Custom classes to replicate 'shadcn/ui' look */
        .card {
            background-color: white;
            border: 1px solid hsl(214.3 31.8% 91.4%);
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .bg-muted\/30 {
            background-color: rgba(243, 244, 246, 0.3);
        }

        .input,
        .select-trigger,
        .textarea {
            display: flex;
            height: 2.5rem;
            /* h-10 */
            width: 100%;
            border-radius: 0.375rem;
            /* rounded-md */
            border: 1px solid hsl(214.3 31.8% 91.4%);
            /* border-input */
            background-color: white;
            padding: 0.5rem 0.75rem;
            /* px-3 py-2 */
            font-size: 0.875rem;
            /* text-sm */
            transition: all 0.2s;
        }

        .input:focus-visible,
        .select-trigger:focus-visible,
        .textarea:focus-visible {
            outline: 2px solid transparent;
            outline-offset: 2px;
            box-shadow: 0 0 0 2px hsl(210 40% 96.1%), 0 0 0 4px hsl(215 27.9% 16.9%);
            /* focus-visible:ring-ring focus-visible:ring-offset-2 */
        }

        .label {
            font-size: 0.875rem;
            /* text-sm */
            font-weight: 500;
            line-height: 1.5rem;
        }
    </style>
</head>

<body class="font-sans">
    <div id="admin-add-trek" class="min-h-screen bg-muted/30">
        <header
            class="sticky top-0 z-50 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
            <div class="container mx-auto flex h-16 items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <a href="#" id="back-to-dashboard"
                        class="flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-primary-foreground">
                            <path d="m8 3 4 8 5-5 5 15H2L8 3z" />
                        </svg>
                    </div>
                    <span class="font-serif text-xl font-bold text-foreground">Trek Admin</span>
                </div>
            </div>
        </header>

        <main class="container mx-auto px-4 py-8">
            <form id="trek-form" method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h1 class="font-serif text-3xl font-bold text-foreground">Add New Trek</h1>
                        <p class="mt-1 text-muted-foreground">Create a new trekking adventure</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" id="cancel-button"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors border border-input bg-white shadow-sm hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                            Cancel
                        </button>
                        <a href="{{ route('admin.index') }}">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground shadow h-10 px-4 py-2 hover:bg-primary/90">
                            Save Trek
                        </button>
                        </a>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="space-y-6 lg:col-span-2">
                        <div class="card">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold tracking-tight">Basic Information</h3>
                                <p class="text-sm text-muted-foreground">Essential details about the trek</p>
                            </div>
                            <div class="p-6 pt-0 space-y-4">
                                <div class="space-y-2">
                                    <label for="trekname" class="label">Trek Name *</label>
                                    <input id="trekname" name="trekname" type="text"
                                        placeholder="e.g., Everest Base Camp Trek" class="input" required
                                        maxlength="100" />
                                </div>

                                <div class="space-y-2">
                                    <label for="tagline" class="label">Tagline</label>
                                    <input id="tagline" name="tagline" type="text"
                                        placeholder="e.g., Journey to the Roof of the World" class="input"
                                        maxlength="150" />
                                </div>

                                <div class="space-y-2">
                                    <label for="region" class="label">Location *</label>
                                    <input id="region" name="region" type="text"
                                        placeholder="e.g., Khumbu Region, Nepal" class="input" required
                                        maxlength="100" />
                                </div>

                                <div class="space-y-2">
                                    <label for="destination_id" class="label">Destination</label>
                                    <select id="destination_id" name="destination_id" class="select-trigger h-10">
                                        <option value="">Select a destination (optional)</option>
                                        @foreach ($destinations as $destination)
                                            <option value="{{ $destination->id }}">{{ $destination->destination_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label for="description" class="label">Description</label>
                                    <textarea id="description" name="description"
                                        placeholder="Describe the trek experience..." class="textarea h-auto" rows="5"
                                        maxlength="2000"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold tracking-tight">Trek Details</h3>
                                <p class="text-sm text-muted-foreground">Duration,and difficulty</p>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    <div class="space-y-2">
                                        <label for="duration" class="label">Duration</label>
                                        <input id="duration" name="duration" type="text" placeholder="e.g., 14 Days"
                                            class="input" maxlength="20" />
                                    </div>

                                    <div class="space-y-2">
                                        <label for="elevation" class="label">Max Elevation</label>
                                        <input id="elevation" name="elevation" type="text" placeholder="e.g., 5,364m"
                                            class="input" maxlength="20" />
                                    </div>

                                    <div class="space-y-2">
                                        <label for="difficultylevel" class="label">Difficulty</label>
                                        <select id="difficultylevel" name="difficultylevel" class="select-trigger h-10">
                                            <option value="">Select difficulty</option>
                                            <option value="Easy">Easy</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="Challenging">Challenging</option>
                                            <option value="Extreme">Extreme</option>
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label for="season" class="label">Best Season</label>
                                        <input id="season" name="season" type="text"
                                            placeholder="e.g., Mar - May, Sep - Nov" class="input" maxlength="50" />
                                    </div>

                                    <div class="space-y-2">
                                        <label for="group_size" class="label">Group Size</label>
                                        <input id="group_size" name="group_size" type="text"
                                            placeholder="e.g., 2-12 people" class="input" maxlength="20" />
                                    </div>

                                    <div class="space-y-2">
                                        <label for="latitude" class="label">Latitude</label>
                                        <input id="latitude" name="latitude" type="number" step="0.0001"
                                            placeholder="e.g., 28.5921" class="input" />
                                    </div>

                                    <div class="space-y-2">
                                        <label for="longitude" class="label">Longitude</label>
                                        <input id="longitude" name="longitude" type="number" step="0.0001"
                                            placeholder="e.g., 86.5882" class="input" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold tracking-tight">Highlights</h3>
                                <p class="text-sm text-muted-foreground">Key attractions and experiences</p>
                            </div>
                            <div id="highlights-container" class="p-6 pt-0 space-y-3">
                                <button type="button" id="add-highlight-button"
                                    class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors border border-input bg-white shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="mr-2">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Add Highlight
                                </button>
                            </div>
                        </div>
                        <script>
                            const addhiBtn = document.getElementById("add-highlight-button");
                            const container1 = document.getElementById("highlights-container");

                            let dayCount1 = 1;

                            addhiBtn.addEventListener("click", () => {
                                const div = document.createElement("div");
                                div.classList.add("space-y-1", "border", "p-3", "rounded-md");

                                div.innerHTML = `
        <label class="block text-sm font-medium">Day ${dayCount1}</label>
        <input type="number" name="highlights[${dayCount1}][day]" value="${dayCount1}" class="border rounded w-full p-2 mb-1" readonly />
        
        <textarea name="highlights[${dayCount1}][description]" placeholder="Description" class="border rounded w-full p-2"></textarea>
    `;

                                container1.appendChild(div);
                                dayCount1++;
                            });

                        </script>

                        <div class="card">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold tracking-tight">Itinerary</h3>
                                <p class="text-sm text-muted-foreground">Day-by-day schedule</p>
                            </div>
                            <div id="itinerary-container" class="p-6 pt-0 space-y-4">
                                <button type="button" id="add-itinerary-button"
                                    class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors border border-input bg-white shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="mr-2">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Add Day
                                </button>
                            </div>
                        </div>
                        <script>
                            const addDayBtn = document.getElementById("add-itinerary-button");
                            const container = document.getElementById("itinerary-container");

                            let dayCount = 1;

                            addDayBtn.addEventListener("click", () => {
                                const div = document.createElement("div");
                                div.classList.add("space-y-1", "border", "p-3", "rounded-md");

                                div.innerHTML = `
        <label class="block text-sm font-medium">Day ${dayCount}</label>
        <input type="number" name="itinerary[${dayCount}][day]" value="${dayCount}" class="border rounded w-full p-2 mb-1" readonly />
        <input type="text" name="itinerary[${dayCount}][title]" placeholder="Title" class="border rounded w-full p-2 mb-1" />
        <textarea name="itinerary[${dayCount}][description]" placeholder="Description" class="border rounded w-full p-2"></textarea>
    `;

                                container.appendChild(div);
                                dayCount++;
                            });

                        </script>

                    </div>

                    <div class="space-y-6">
                        <div class="card">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold tracking-tight">Pricing</h3>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="space-y-2">
                                    <label for="price" class="label">Price per Person (USD) *</label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground">$</span>
                                        <input id="price" name="price" type="number" placeholder="0" class="input pl-7"
                                            required min="0" max="100000" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold tracking-tight">Images</h3>
                                <p class="text-sm text-muted-foreground">Upload trek photos</p>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="space-y-4">
                                    <label for="trek-images" class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-muted-foreground/25 p-8 text-center transition-colors hover:border-muted-foreground/50 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="mb-2 h-8 w-8 text-muted-foreground">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                            <polyline points="17 8 12 3 7 8" />
                                            <line x1="12" x2="12" y1="3" y2="15" />
                                        </svg>
                                        <p class="text-sm text-muted-foreground">
                                            Drag & drop images here
                                        </p>
                                        <p class="mt-1 text-xs text-muted-foreground">
                                            or click to browse
                                        </p>
                                        <input id="trek-images" type="file" name="trek_images[]" multiple accept="image/*" class="hidden" />
                                    </label>
                                    <div id="images-preview" class="grid grid-cols-2 gap-4"></div>
                                </div>
                            </div>
                        </div>

                        <script>
                            const fileInput = document.getElementById('trek-images');
                            const previewContainer = document.getElementById('images-preview');
                            const dropZone = document.querySelector('label[for="trek-images"]');

                            // Handle file selection
                            fileInput.addEventListener('change', handleFiles);

                            // Drag and drop
                            dropZone.addEventListener('dragover', (e) => {
                                e.preventDefault();
                                dropZone.classList.add('border-primary', 'bg-primary/5');
                            });

                            dropZone.addEventListener('dragleave', () => {
                                dropZone.classList.remove('border-primary', 'bg-primary/5');
                            });

                            dropZone.addEventListener('drop', (e) => {
                                e.preventDefault();
                                dropZone.classList.remove('border-primary', 'bg-primary/5');
                                fileInput.files = e.dataTransfer.files;
                                handleFiles();
                            });

                            function handleFiles() {
                                previewContainer.innerHTML = '';
                                const files = Array.from(fileInput.files);

                                files.forEach((file, index) => {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        const div = document.createElement('div');
                                        div.className = 'relative group';
                                        div.innerHTML = `
                                            <img src="${e.target.result}" alt="Preview" class="h-32 w-full object-cover rounded-lg border" />
                                            <button type="button" onclick="removeImage(${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        `;
                                        previewContainer.appendChild(div);
                                    };
                                    reader.readAsDataURL(file);
                                });
                            }

                            function removeImage(index) {
                                const dt = new DataTransfer();
                                const files = Array.from(fileInput.files);
                                files.splice(index, 1);
                                files.forEach(file => dt.items.add(file));
                                fileInput.files = dt.files;
                                handleFiles();
                            }
                        </script>

                        <div class="card">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold tracking-tight">Status</h3>
                            </div>
                            <div class="p-6 pt-0">
                                <select id="status" name="status" class="select-trigger h-10" value="draft">
                                    <option value="draft">Draft</option>
                                    <option value="active">Active</option>
                                </select>
                                <p class="mt-2 text-xs text-muted-foreground">
                                    Draft treks are not visible to the public
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
    
</body>

</html>