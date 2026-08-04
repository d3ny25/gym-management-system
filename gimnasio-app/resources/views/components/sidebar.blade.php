<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-[#0F172A] text-white transform -translate-x-full transition-transform duration-200 md:translate-x-0 md:static md:flex md:flex-col shadow-xl">
    <div class="h-full p-4">
        <div class="mb-6 px-2 text-lg font-semibold tracking-wide">Panel</div>
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-[#1E293B] hover:text-[#F8FAFC] transition">Inicio</a>
            <a href="{{ route('clientes.index') }}" class="block px-3 py-2 rounded hover:bg-[#1E293B] hover:text-[#F8FAFC] transition">Clientes</a>
            <a href="{{ route('usuarios.index') }}" class="block px-3 py-2 rounded hover:bg-[#1E293B] hover:text-[#F8FAFC] transition">Usuarios</a>
            <a href="{{ route('membresias.index') }}" class="block px-3 py-2 rounded hover:bg-[#1E293B] hover:text-[#F8FAFC] transition">Membresías</a>
            <a href="{{ route('inscripciones.index') }}" class="block px-3 py-2 rounded hover:bg-[#1E293B] hover:text-[#F8FAFC] transition">Inscripciones</a>
            <a href="{{ route('pagos.index') }}" class="block px-3 py-2 rounded hover:bg-[#1E293B] hover:text-[#F8FAFC] transition">Pagos</a>
        </nav>
    </div>
</aside>
