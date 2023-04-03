<x-template title="Kelas Order">
    <div class="row">
        <div class="col-md-12">
            <x-element.card title="Data Kelas Order">
                <x-slot name="button">

                </x-slot>
                <x-element.table
                    :header="['No','Kode Pembelian','Kode Referal','Nama','Total Pembayaran','Metode Pembayaran','Status']">

                </x-element.table>
            </x-element.card>
        </div>
    </div>
</x-template>
