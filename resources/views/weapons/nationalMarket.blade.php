<x-layouts.app :title="__('Market')">
    <!-- Market view -->
    <section class="pt-10">
        <div class="no-underline flex gap-4 text-[#bbb] text-xl font-bold px-[10px] py-[5px]  m-[10px]">

            <x-header-element header="/market/international">International Market</x-header-element>
            <x-header-element header="/market/national">National Market</x-header-element>

        </div>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-8 mt-6">
            @foreach ($weapons as $weapon)
                <x-card :weapon="$weapon" />
            @endforeach

        </div>

        <div class="mt-6">
    {{ $weapons->links() }}
</div>
    </section>
</x-layouts.app>
