@extends('layouts.admin')

@section('title', 'Edit User - ' . $user->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.show', $user) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
        ← Back to User Details
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow" x-data="editUserForm()">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Edit User</h2>
    </div>
    <div class="p-6">
        <form @submit.prevent="submitForm">
            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                <input type="text" name="name" id="name" x-model="formData.name"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                       required>
                <p x-show="errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400" x-text="errors.name"></p>
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" name="email" id="email" x-model="formData.email"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                       required>
                <p x-show="errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400" x-text="errors.email"></p>
            </div>

            <!-- Plan -->
            <div class="mb-6">
                <label for="plan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Plan</label>
                <select name="plan_id" id="plan_id" x-model="formData.plan_id"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Free (No Plan)</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->name }} - ${{ $plan->price }}</option>
                    @endforeach
                </select>
                <p x-show="errors.plan_id" class="mt-1 text-sm text-red-600 dark:text-red-400" x-text="errors.plan_id"></p>
            </div>

            <!-- Admin Status -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Administrator</label>
                <div class="flex space-x-3">
                    <button type="button" @click="formData.is_admin = true"
                            :class="formData.is_admin ? 'bg-purple-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                            class="px-4 py-2 rounded-lg transition font-medium">
                        Yes
                    </button>
                    <button type="button" @click="formData.is_admin = false"
                            :class="!formData.is_admin ? 'bg-gray-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                            class="px-4 py-2 rounded-lg transition font-medium">
                        No
                    </button>
                </div>
                <p x-show="errors.is_admin" class="mt-1 text-sm text-red-600 dark:text-red-400" x-text="errors.is_admin"></p>
            </div>

            <!-- Pana Status -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pana</label>
                <div class="flex space-x-3">
                    <button type="button" @click="formData.is_pana = true"
                            :class="formData.is_pana ? 'bg-yellow-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                            class="px-4 py-2 rounded-lg transition font-medium">
                        Yes
                    </button>
                    <button type="button" @click="formData.is_pana = false"
                            :class="!formData.is_pana ? 'bg-gray-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                            class="px-4 py-2 rounded-lg transition font-medium">
                        No
                    </button>
                </div>
                <p x-show="errors.is_pana" class="mt-1 text-sm text-red-600 dark:text-red-400" x-text="errors.is_pana"></p>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Cancel
                </a>
                <button type="submit" 
                        :disabled="loading"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!loading">Save Changes</span>
                    <span x-show="loading">Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function editUserForm() {
    return {
        formData: {
            name: '{{ old('name', $user->name) }}',
            email: '{{ old('email', $user->email) }}',
            plan_id: '{{ old('plan_id', $user->plan_id) }}',
            is_admin: {{ old('is_admin', $user->is_admin) ? 'true' : 'false' }},
            is_pana: {{ old('is_pana', $user->is_pana) ? 'true' : 'false' }}
        },
        errors: {},
        loading: false,

        async submitForm() {
            this.loading = true;
            this.errors = {};

            try {
                const response = await fetch('{{ route('admin.users.update', $user) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'PATCH',
                        ...this.formData,
                        is_admin: this.formData.is_admin ? 1 : 0,
                        is_pana: this.formData.is_pana ? 1 : 0
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    window.location.href = '{{ route('admin.users.show', $user) }}';
                } else if (response.status === 422) {
                    this.errors = data.errors || {};
                } else {
                    alert('An error occurred. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
@endpush
@endsection
