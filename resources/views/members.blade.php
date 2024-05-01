<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('add-member.data') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded">  {{ __('Add Member') }}
                </a>
            </div>
            <div class="bg-white dark:bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-800 uppercase tracking-wider">
                                National ID
                            </th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-gray-800 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody id="members-data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        async function loadBooks() {
            try {
                const response = await fetch('{{ route('members.data') }}'); // Replace with actual route name
                const data = await response.json();
                const tableBody = document.getElementById('members-data');
                tableBody.innerHTML = ''; // Clear existing content

                for (const member of data) {
                    const tableRow = `
                        <tr>
                            <td class="px-6 py-4 text-left text-sm font-base text-gray-600">
                                ${member.name}
                            </td>
                            <td class="px-6 py-4 text-left text-sm font-base text-gray-600">
                                ${member.national_id}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-base text-gray-600">
                                <a href="/members/edit/${member.id}" class="px-2 py-1 font-bold text-white bg-green-500 rounded" data-id="${member.id}">Edit</a>
                                <form action="/members/delete/${member.id}" method="POST" class="inline-block d-none" data-id="${member.id}">
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
