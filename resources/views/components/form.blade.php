<form x-data="{
    loading: false,
    errors: null,
    async handleSubmit(event) {
        this.loading = true;
        const response = await formSubmit(event);
        this.errors = response.errors;
        this.loading = false;
        if (!response.success) window.toast(response.message || 'Permintaan gagal', { type: 'danger' });
    },
}" {{ $attributes }} @submit="handleSubmit($event)">
    {{ $slot }}
</form>
