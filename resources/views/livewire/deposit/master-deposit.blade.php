<div style="width: 100%">
        <span>Deposit : </span>
        <span class="">
            @php
                print_r($count);
            @endphp
        </span>
    @foreach ($deposits as $index => $deposit)
        @if ($deposit->status == 'Pending')
            <div class="alert alert-success" role="alert">
                <div class="row">
                    <div class="col-md-4">{{$deposit->created_at}}</div>
                    <div class="col-md-4 text-center">Deposit dari : {{$deposit->rekening_asal}}</div>
                    <div class="col-md-4 text-right">Jumlah : {{$deposit->jumlah}}</div>
                </div>
            </div>
        @endif
    @endforeach
    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-8" style="background: #8deab3">
                    <p style="position: relative;top: 8px;">Deposit in progress</p>
                </div>
                <div class="col-md-4">
                    <input wire:model="search" type="text" class="form-control" placeholder="Search Deposit">
                </div>
            </div>
            <table class="table table-bordered ">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Rekening Tujuan</th>
                        <th>Rekening Asal</th>
                        <th>Jumlah</th>
                        <th>Catatan: Nomor Rekord / Referensi</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($deposits as $index => $deposit)
                    @if ($deposit->status == 'Pending')
                        <tr class="text-center">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $deposit->rekening->name }}</td>
                            <td>{{ $deposit->rekening_asal }}</td>
                            <td>{{ $deposit->jumlah }}</td>
                            <td>{{ $deposit->catatan }}</td>
                            <td>
                                <button wire:click="approved({{$deposit->id}})" title="approve" class="btn btn-info btn-sm"><i class="fas fa-check"></i></button>
                                <button wire:click="edit({{$deposit->id}})" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                <button wire:click="delete({{$deposit->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                
                            </td>
                        </tr>
                    @endif  
                @empty
                <h5 class="text-center font-weight-bold text-primary">No Deposit found</h5>
                @endforelse
        
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-8" style="background: #8deab3">
                    <p style="position: relative;top: 8px;">Deposit Approved</p>
                </div>
                <div class="col-md-4">
                    <input wire:model="search" type="text" class="form-control" placeholder="Search Deposit">
                </div>
            </div>
            <table class="table table-bordered ">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Rekening Tujuan</th>
                        <th>Rekening Asal</th>
                        <th>Jumlah</th>
                        <th>Catatan: Nomor Rekord / Referensi</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($deposits as $index => $deposit)
                    @if ($deposit->status == 'Approve')
                        <tr class="text-center">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $deposit->name }}</td>
                            <td>{{ $deposit->rekening_asal }}</td>
                            <td>{{ $deposit->jumlah }}</td>
                            <td>{{ $deposit->catatan }}</td>
                            <td>
                                <button wire:click="reload({{$deposit->id}})" title="reload" class="btn btn-info btn-sm"><i class="fas fa-redo-alt"></i></button>
                                <button wire:click="edit({{$deposit->id}})" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                <button wire:click="delete({{$deposit->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                
                            </td>
                        </tr>
                    @endif
                        
                @empty
                    <h5 class="text-center font-weight-bold text-primary">No Deposit found</h5>
                @endforelse
        
                </tbody>
            </table>
        </div>
    </div>
</div>
