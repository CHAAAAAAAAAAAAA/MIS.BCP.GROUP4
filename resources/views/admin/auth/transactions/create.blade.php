<x-admin-layout>
    <div class="bg-gradient-to-r from-slate-800 to-slate-700 shadow-md rounded-xl p-6 mb-6">
        <h3 class="text-2xl font-bold text-white">
            Add New Transaction 📝
        </h3>
        <p class="mt-2 text-slate-300 text-sm">
            Fill out the form below to record a new transaction.
        </p>
    </div>

    <form method="POST" action="{{ route('admin.transactions.store') }}" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700">Amount</label>
            <input type="number" name="amount" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700">Description</label>
            <input type="text" name="description" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm" required>
        </div>

        <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-700 transition">
            Save Transaction
        </button>
    </form>
</x-admin-layout>