@extends('Backend.Layouts.master')
@section('title', 'Configurations')
@section('master-content')
    <div class="card">
        <div class="max-w-7xl mx-auto p-4">
            <h5 class="fw-bolder">Manage Configurations</h5>
        </div>
        <div class="">
            @if($configer)
        <form action="{{ route('admin.configer.update', $configer->id) }}" method="POST" enctype="multipart/form-data" id="founder_form" class="max-w-7xl mx-auto p-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Basic Information Card -->
                    <div class=" rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[var(--primary)] font-bold text-lg">Basic Informations</h3>
                        </div>
                        <div class="p-6 space-y-5">
                            
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Company Name</label>
                                <input type="text" name="name" value="{{ old('name', $configer->name) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 " >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Company Email</label>
                                <input type="text" name="email" value="{{ old('email', $configer->email) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 " >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-400 mb-1">Company Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $configer->phone) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 " >
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-400 mb-1">Company Address</label>
                                <textarea name="address" rows="3" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 ">{{ old('address', $configer->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Video -->
                            <div>
                                <label for="video" class="block text-sm font-medium text-gray-400 mb-1">Promo Video</label>
                                <p class="text-xs text-gray-500 mb-2">For auto play paste it last in the video url: <code class="bg-gray-100 px-1 rounded">autoplay=1&mute=1</code></p>
                                <input type="text" name="video" value="{{ old('video', $configer->video) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 " >
                                @error('video')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Image Gallery Card -->
                    <div class=" rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[var(--primary)] font-bold text-lg">Image Gallery</h3>
                        </div>
                        <div class="p-6 flex flex-wrap gap-8">
                            
                            <!-- Logo 1 -->
                            <div class="relative w-[150px] h-[150px] border border-[#ffffff28] rounded-lg p-1 group">
                                <img id="ImagePreview" class="w-full h-full object-contain" src="{{ asset($configer->logo ? $configer->logo : 'img-preview.png') }}" alt="Logo 1">
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-black/60 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="text-white fa-solid fa-pen-to-square text-3xl"></i>
                                    </div>
                                    <input type="file" name="logo" id="image" 
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                            </div>

                            <!-- Logo 2 -->
                            <div class="relative w-[150px] h-[150px] border border-[#ffffff28] rounded-lg p-1 group">
                                <img id="ImagePreview_two" class="w-full h-full object-contain" src="{{ asset($configer->logo_two ? $configer->logo_two : 'img-preview.png') }}" alt="Logo 2">
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-black/60 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="text-white fa-solid fa-pen-to-square text-3xl"></i>
                                    </div>
                                    <input type="file" name="logo_two" id="image_two" 
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Social Media Card -->
                    <div class=" rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[var(--primary)] font-bold text-lg">Social Media</h3>
                        </div>
                        <div class="p-6 space-y-5">
                            
                            <div>
                                <label for="facebook" class="block text-sm font-medium text-gray-400 mb-1">Facebook</label>
                                <input type="text" name="facebook" value="{{ old('facebook', $configer->facebook) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 ">
                                @error('facebook')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="twitter" class="block text-sm font-medium text-gray-400 mb-1">Twitter</label>
                                <input type="text" name="twitter" value="{{ old('twitter', $configer->twitter) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 ">
                                @error('twitter')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="instagram" class="block text-sm font-medium text-gray-400 mb-1">Instagram</label>
                                <input type="text" name="instagram" value="{{ old('instagram', $configer->instagram) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 ">
                                @error('instagram')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="youtube" class="block text-sm font-medium text-gray-400 mb-1">Youtube</label>
                                <input type="text" name="youtube" value="{{ old('youtube', $configer->youtube) }}" 
                                    class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 ">
                                @error('youtube')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Content Body Card -->
                    <div class=" rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[var(--primary)] font-bold text-lg">Content Body</h3>
                        </div>
                        <div class="p-6">
                            
                            <div class="mb-3">
                                <label for="companydetail" class="block text-sm font-medium text-gray-400 mb-1">Company Details</label>
                                
                                @php
                                    $strippedContent  = strip_tags($configer->companydetail);
                                @endphp

                                
                                <!-- Edit View (Hidden by default via 'd-none' simulation) -->
                                <div id="text-area-edit">
                                    <div>
                                        <textarea name="companydetail" class="w-full bg-transparent rounded-lg   border border-[#ffffff28] px-4 py-2.5 focus:border-[var(--primary)] focus:ring-[var(--primary)] shadow-sm char-count summernote" rows="10" data-limit="700">{!! old('companydetail', $configer->companydetail) !!}</textarea>
                                        <div class="flex items-center gap-4 mt-2">
                                            <span class="text-sm text-gray-500 counter">0/700</span>
                                            <span class="text-sm text-red-500 error hidden">Character limit exceeded!</span>
                                        </div>
                                    </div>
                                </div>

                                @error('companydetail')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Update Button Container (Hidden by default) -->
            <div class="flex justify-end mt-4" id="update_btn">
                <button type="submit" class="flex items-center gap-2 bg-[var(--primary)] text-white px-6 py-2.5 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-[var(--primary)]/30 transition-all font-medium shadow-sm">
                    <i class="fa-solid fa-floppy-disk"></i> Save
                </button>
            </div>

        </form>
            @else
        <form action="{{ route('admin.configer.store') }}" method="POST" enctype="multipart/form-data" class="max-w-7xl mx-auto p-4">
            @csrf
            @method('post')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Basic Information Card -->
                    <div class="rounded-xl shadow-sm border border-[#ffffff28]  overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[#6366f1] font-bold text-lg">Basic Informations</h3>
                        </div>
                        <div class="p-6 space-y-5">
                            
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Company Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" 
                                    class="w-full bg-transparent rounded-lg border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200" >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Company Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200" >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-400 mb-1">Company Phone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200" >
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-400 mb-1">Company Address</label>
                                <textarea name="address" rows="3" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Video -->
                            <div>
                                <label for="video" class="block text-sm font-medium text-gray-400 mb-1">Promo Video</label>
                                <p class="text-xs text-gray-500 mb-2">For auto play paste it last in the video url: <code class="bg-gray-100 px-1 rounded text-gray-600">autoplay=1&mute=1</code></p>
                                <input type="text" name="video" value="{{ old('video') }}" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200" >
                                @error('video')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Image Gallery Card -->
                    <div class="rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[#6366f1] font-bold text-lg">Image Gallery</h3>
                        </div>
                        <div class="p-6 flex flex-wrap gap-8">
                            
                            <!-- Logo 1 -->
                            <div class="relative w-[150px] h-[150px] border border-[#ffffff28] rounded-lg p-1 group">
                                <img id="ImagePreview" class="w-full h-full object-contain" src="{{ asset('img-preview.png') }}" alt="Logo 1">
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-[#6366f1]/90 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer flex items-center justify-center">
                                    <i class="text-white fa-solid fa-pen-to-square text-3xl"></i>
                                </div>
                                <input type="file" name="logo" id="image" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            </div>

                            <!-- Logo 2 -->
                            <div class="relative w-[150px] h-[150px] border border-[#ffffff28] rounded-lg p-1 group">
                                <img id="ImagePreview_two" class="w-full h-full object-contain" src="{{ asset('img-preview.png') }}" alt="Logo 2">
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-[#6366f1]/90 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer flex items-center justify-center">
                                    <i class="text-white fa-solid fa-pen-to-square text-3xl"></i>
                                </div>
                                <input type="file" name="logo_two" id="image_two" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Social Media Card -->
                    <div class="rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[#6366f1] font-bold text-lg">Social Media</h3>
                        </div>
                        <div class="p-6 space-y-5">
                            
                            <div>
                                <label for="facebook" class="block text-sm font-medium text-gray-400 mb-1">Facebook</label>
                                <input type="text" name="facebook" value="{{ old('facebook') }}" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200">
                                @error('facebook')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="twitter" class="block text-sm font-medium text-gray-400 mb-1">Twitter</label>
                                <input type="text" name="twitter" value="{{ old('twitter') }}" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200">
                                @error('twitter')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="instagram" class="block text-sm font-medium text-gray-400 mb-1">Instagram</label>
                                <input type="text" name="instagram" value="{{ old('instagram') }}" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200">
                                @error('instagram')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="youtube" class="block text-sm font-medium text-gray-400 mb-1">Youtube</label>
                                <input type="text" name="youtube" value="{{ old('youtube') }}" 
                                    class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5  focus:border-[#6366f1] focus:ring-[#6366f1] focus:transition duration-200">
                                @error('youtube')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Content Body Card -->
                    <div class="rounded-xl shadow-sm border border-[#ffffff28] overflow-hidden">
                        <div class=" px-6 py-4 border-b border-[#ffffff28] ">
                            <h3 class="text-[#6366f1] font-bold text-lg">Content Body</h3>
                        </div>
                        <div class="p-6">
                            
                            <div class="mb-3">
                                <label for="companydetail" class="block text-sm font-medium text-gray-400 mb-1">Company Details</label>

                                <!-- Edit View (Hidden by default via 'd-none' simulation) -->
                                <div id="text-area-edit" class="">
                                    <div>
                                        <textarea name="companydetail" class="w-full bg-transparent rounded-lg  border-[#ffffff28]  border px-4 py-2.5 focus:border-[#6366f1] focus:ring-[#6366f1] shadow-sm char-count summernote" rows="10" data-limit="700">{!! old('companydetail') !!}</textarea>
                                        <div class="flex items-center gap-4 mt-2">
                                            <span class="text-sm text-gray-500 counter">0/700</span>
                                            <span class="text-sm text-red-500 error hidden">Character limit exceeded!</span>
                                        </div>
                                    </div>
                                </div>

                                @error('companydetail')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Update Button Container (Hidden by default) -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="flex items-center gap-2 bg-[var(--primary)] text-white px-6 py-2.5 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-[var(--primary)]/30 transition-all font-medium shadow-sm">
                    <i class="fa-solid fa-floppy-disk"></i> Save
                </button>
            </div>

        </form>
            @endif

        </div>
    </div>
@endsection

@push('script')
<script>
   
</script>
@endpush
