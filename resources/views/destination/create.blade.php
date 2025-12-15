<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add New Destination - Admin</title>
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
		.card {
			background-color: white;
			border: 1px solid hsl(214.3 31.8% 91.4%);
			border-radius: 0.5rem;
			box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
		}
		.bg-muted\/30 { background-color: rgba(243, 244, 246, 0.3); }
		.input, .select-trigger, .textarea {
			display: flex; height: 2.5rem; width: 100%; border-radius: 0.375rem;
			border: 1px solid hsl(214.3 31.8% 91.4%); background-color: white; padding: 0.5rem 0.75rem;
			font-size: 0.875rem; transition: all 0.2s;
		}
		.textarea { height: auto; }
		.input:focus-visible, .select-trigger:focus-visible, .textarea:focus-visible {
			outline: 2px solid transparent; outline-offset: 2px;
			box-shadow: 0 0 0 2px hsl(210 40% 96.1%), 0 0 0 4px hsl(215 27.9% 16.9%);
		}
		.label { font-size: 0.875rem; font-weight: 500; line-height: 1.5rem; }
	</style>
</head>

<body class="font-sans">
	<div id="admin-add-destination" class="min-h-screen bg-muted/30">
		<header class="sticky top-0 z-50 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
			<div class="container mx-auto flex h-16 items-center justify-between px-4">
				<div class="flex items-center gap-3">
					<a href="{{ route('destinations.index') }}" class="flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m12 19-7-7 7-7" />
							<path d="M19 12H5" />
						</svg>
						Back to Destinations
					</a>
				</div>
				<div class="flex items-center gap-3">
					<div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-foreground">
							<path d="m8 3 4 8 5-5 5 15H2L8 3z" />
						</svg>
					</div>
					<span class="font-serif text-xl font-bold text-foreground">Trek Admin</span>
				</div>
			</div>
		</header>

		<main class="container mx-auto px-4 py-8">
			@if ($errors->any())
				<div class="mb-6 rounded-lg border border-red-500/30 bg-red-500/10 text-red-700 px-4 py-3">
					<ul class="list-disc list-inside space-y-1">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form id="destination-form" method="POST" action="{{ route('destinations.store') }}" enctype="multipart/form-data">
				@csrf
				<div class="mb-8 flex items-center justify-between">
					<div>
						<h1 class="font-serif text-3xl font-bold text-foreground">Add New Destination</h1>
						<p class="mt-1 text-muted-foreground">Create a new destination entry</p>
					</div>
					<div class="flex gap-3">
						<a href="{{ route('destinations.index') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors border border-input bg-white shadow-sm hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">Cancel</a>
						<button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground shadow h-10 px-4 py-2 hover:bg-primary/90">Save Destination</button>
					</div>
				</div>

				<div class="grid gap-6 lg:grid-cols-3">
					<div class="space-y-6 lg:col-span-2">
						<div class="card">
							<div class="p-6">
								<h3 class="text-lg font-semibold tracking-tight">Basic Information</h3>
								<p class="text-sm text-muted-foreground">Essential details about the destination</p>
							</div>
							<div class="p-6 pt-0 space-y-4">
								<div class="space-y-2">
									<label for="destination_name" class="label">Destination Name *</label>
									<input id="destination_name" name="destination_name" type="text" value="{{ old('destination_name') }}" placeholder="e.g., Annapurna Region" class="input" required maxlength="150" />
								</div>
								<div class="space-y-2">
									<label for="tagline" class="label">Tagline</label>
									<input id="tagline" name="tagline" type="text" value="{{ old('tagline') }}" placeholder="e.g., Gateway to Himalayan Wonders" class="input" maxlength="150" />
								</div>
								<div class="space-y-2">
									<label for="region" class="label">Region *</label>
									<input id="region" name="region" type="text" value="{{ old('region') }}" placeholder="e.g., Annapurna" class="input" required maxlength="100" />
								</div>
								<div class="space-y-2">
									<label for="description" class="label">Description *</label>
									<textarea id="description" name="description" placeholder="Describe the destination..." class="textarea" rows="5" required maxlength="2000">{{ old('description') }}</textarea>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="p-6">
								<h3 class="text-lg font-semibold tracking-tight">Destination Details</h3>
								<p class="text-sm text-muted-foreground">Elevation, best season, treks available</p>
							</div>
							<div class="p-6 pt-0">
								<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
									<div class="space-y-2">
										<label for="elevation" class="label">Elevation</label>
										<input id="elevation" name="elevation" type="text" value="{{ old('elevation') }}" placeholder="e.g., 4,130 m" class="input" maxlength="50" />
									</div>
									<div class="space-y-2">
										<label for="best_season" class="label">Best Season</label>
										<input id="best_season" name="best_season" type="text" value="{{ old('best_season') }}" placeholder="e.g., Mar - May, Sep - Nov" class="input" maxlength="80" />
									</div>
									<div class="space-y-2 lg:col-span-1 sm:col-span-2">
										<label for="treks_available" class="label">Treks Available</label>
										<input id="treks_available" name="treks_available" type="text" value="{{ old('treks_available') }}" placeholder="e.g., ABC, Ghorepani Poon Hill" class="input" maxlength="200" />
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="space-y-6">
						<div class="card">
							<div class="p-6">
								<h3 class="text-lg font-semibold tracking-tight">Hero Image</h3>
								<p class="text-sm text-muted-foreground">Upload a featured image</p>
							</div>
							<div class="p-6 pt-0">
								<div class="space-y-4">
									<label for="destination-image" class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-muted-foreground/25 p-8 text-center transition-colors hover:border-muted-foreground/50 cursor-pointer">
										<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-2 h-8 w-8 text-muted-foreground">
											<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
											<polyline points="17 8 12 3 7 8" />
											<line x1="12" x2="12" y1="3" y2="15" />
										</svg>
										<p class="text-sm text-muted-foreground">Drag & drop an image here</p>
										<p class="mt-1 text-xs text-muted-foreground">or click to browse</p>
										<input id="destination-image" type="file" name="path" accept="image/*" class="hidden" />
									</label>
									<div id="image-preview" class="grid grid-cols-1 gap-4"></div>
									<p class="text-xs text-muted-foreground">Accepted: JPG, PNG, GIF, WEBP. Max 4MB.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</main>
	</div>

	<script>
		const fileInput = document.getElementById('destination-image');
		const previewContainer = document.getElementById('image-preview');
		const dropZone = document.querySelector('label[for="destination-image"]');

		fileInput.addEventListener('change', handleFiles);
		dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('border-primary', 'bg-primary/5'); });
		dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('border-primary', 'bg-primary/5'); });
		dropZone.addEventListener('drop', (e) => { e.preventDefault(); dropZone.classList.remove('border-primary', 'bg-primary/5'); fileInput.files = e.dataTransfer.files; handleFiles(); });

		function handleFiles() {
			previewContainer.innerHTML = '';
			const files = Array.from(fileInput.files).slice(0, 1);
			files.forEach((file) => {
				const reader = new FileReader();
				reader.onload = (e) => {
					const div = document.createElement('div');
					div.className = 'relative';
					div.innerHTML = `<img src="${e.target.result}" alt="Preview" class="h-40 w-full object-cover rounded-lg border" />`;
					previewContainer.appendChild(div);
				};
				reader.readAsDataURL(file);
			});
		}
	</script>

</body>

</html>
