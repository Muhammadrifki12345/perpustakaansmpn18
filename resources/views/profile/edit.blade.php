<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in">
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Pengaturan Profil ⚙️</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan keamanan.</p>
            </div>

            <div class="space-y-6">
                <div class="surface-card">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="surface-card">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="surface-card">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
