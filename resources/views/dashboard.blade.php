<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('add-book.data') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded">  {{ __('Add Book') }}
                </a>
            </div>
            <div class="bg-white dark:bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 uppercase tracking-wider">
                                Title
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 uppercase tracking-wider">
                                Author
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 uppercase tracking-wider">
                                Genre
                            </th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-gray-800 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody id="book-data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        async function loadBooks() {
            try {
                const response = await fetch('{{ route('books.data') }}'); // Replace with actual route name
                const data = await response.json();
                const tableBody = document.getElementById('book-data');
                tableBody.innerHTML = ''; // Clear existing content

                for (const book of data) {
                    const tableRow = `
                        <tr>
                            <td class="px-6 py-4 text-left text-sm font-base text-gray-600">
                                ${book.name}
                            </td>
                            <td class="px-6 py-4 text-left text-sm font-base text-gray-600">
                                ${book.author}
                            </td>
                            <td class="px-6 py-4 text-left text-sm font-base text-gray-600">
                                ${book.genre}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-base text-gray-600">
                                <a href="/books/edit/${book.id}" class="px-2 py-1 font-bold text-white bg-green-500 rounded" data-id="${book.id}">Edit</a>

                                <form action="/books/delete/${book.id}" method="POST" class="inline-block d-none" data-id="${book.id}">
                                    @csrf
                                 @method('DELETE')
                                    <button type="submit" class="px-2 py-1 font-bold text-white bg-red-500 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += tableRow;
                }
            } catch (error) {
                console.error('Error fetching books:', error);
                // Handle errors appropriately, e.g., display an error message to the user
            }
        }

        loadBooks(); // Call the function on page load
    </script>
</x-app-layout>
