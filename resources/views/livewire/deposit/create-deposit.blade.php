<div class="card" style="width: 100%">
    <div class="card-header">
      Deposit
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="form-group">
              <label>Rekening Tujuan:</label>
                <select wire:model="rekening_id" class="form-control @error('rekening_id') is-invalid @enderror">
                    <option value="">Pilih Rekening Tujuan</option>
                    @foreach($rekening as $rek)
                    <option value="{{ $rek->id }}">{{ $rek->name }}</option>
                    @endforeach
                </select>
                @error('rekening_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label >Rekening Asal</label>
                <input wire:model="rekening_asal" type="text" class="form-control @error('rekening_asal') is-invalid @enderror" placeholder="Rekening Asal">
                @error('rekening_asal') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label >Jumlah</label>
                <input wire:model="jumlah" type="number" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Jumlah">
                @error('jumlah') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
              <label >Catatan: No Rekord / Referensi</label>
              <input wire:model="catatan" type="text" class="form-control @error('catatan') is-invalid @enderror" placeholder="Catatan">
              @error('catatan') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; margin:0 !important">Submit</button>
        </form>
    </div>
  </div>

