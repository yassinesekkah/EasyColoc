<div 
    id="categoryModal"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div 
        id="categoryModalContent"
        class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Manage Categories</h3>
            <button id="closeCategoryModalBtn" class="text-gray-400 hover:text-gray-600">
                ✕
            </button>
        </div>

        <div class="p-6 space-y-6">

            <!-- Add Category Form -->
            <form method="POST" action="{{ route('categories.store', $activeColocation->id) }}" class="space-y-3">
                @csrf
                <input type="text" name="name" placeholder="New category name" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-semibold">
                    Add Category
                </button>
                
            </form>

            <!-- Existing Categories -->
            <div>
                <h4 class="text-sm font-semibold text-gray-600 mb-2">Existing Categories</h4>

                <ul class="space-y-2">
                    @foreach($activeColocation->categories as $category)
                        <li class="px-3 py-2 bg-gray-50 rounded-lg text-sm text-gray-700">
                            {{ $category->name }}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>