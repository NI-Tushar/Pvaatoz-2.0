@extends("Backend.Layouts.master")
@push('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Testimonial')
@section('master-content')
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <!-- Terms & Conditions List (Editable) -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Manage Terms & Conditions</h2>

                    @if($terms_data->count() > 0)
                        <div class="space-y-8">
                            @foreach($terms_data as $item)
                                <form action="{{ route('admin.terms.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <!-- 
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-700">#{{ $loop->iteration }} — Edit Term</h3>

                                    </div> -->

                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-1">Heading</label>
                                            <input 
                                                type="text"
                                                name="title"
                                                value="{{ old('title', $item->title) }}"
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                                                required>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-1">Description</label>
                                            <textarea
                                                name="content"
                                                class="content-textarea w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none resize-none overflow-hidden"
                                                oninput="autoResize(this)"
                                                required
                                            >{{ old('content', $item->content) }}</textarea>
                                        </div>

                                        <script>
                                            function autoResize(textarea) {
                                                textarea.style.height = 'auto';
                                                textarea.style.height = textarea.scrollHeight + 'px';
                                            }

                                            // Run on page load for all textareas
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const textareas = document.querySelectorAll('.content-textarea');
                                                textareas.forEach(textarea => autoResize(textarea));
                                            });
                                        </script>


                                        <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.terms.delete', $item->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                                    class="text-red-600 font-medium rounded-lg px-4 py-2 border border-red-600 hover:bg-red-800 hover:text-white transition">
                                                        Delete
                                                </a>
                                            <button type="submit"
                                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                                                Update
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-6">No Terms & Conditions found.</p>
                    @endif
                </div>
                <!--  -->
                <!-- Add New Terms & Conditions -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Add Terms & Conditions</h2>

                    <form action="{{ route('admin.terms.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Heading</label>
                            <input 
                                type="text" 
                                name="title" 
                                placeholder="Enter page title (e.g., Terms & Conditions)" value="{{ old('title') }}"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                                required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Description</label>
                            <textarea 
                                name="content" 
                                rows="7"
                                placeholder="Paste or write your terms and conditions content here..."
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none resize-y"
                                required
                            >{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button 
                                type="submit"
                                class="bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 transition duration-300 font-medium"
                            >
                                Save Terms & Conditions
                            </button>
                        </div>
                    </form>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
</script>
@endpush
