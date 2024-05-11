<div class="progress-group">
    Goloangan Darah A
    <span class="float-right"><b>{{ $progres[0]->goldar_A}}</b>/{{ $progres[0]->ALL_STOK}}</span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-primary" style="width: {{ $progres[0]->goldar_A / $progres[0]->ALL_STOK * 100 }}%"></div>
    </div>
</div>
<div class="progress-group">
    Golongan Darah B
    <span class="float-right"><b>{{ $progres[0]->goldar_B}}</b>/{{ $progres[0]->ALL_STOK}}</span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-danger" style="width: {{ $progres[0]->goldar_B / $progres[0]->ALL_STOK * 100 }}%"></div>
    </div>
</div>

<div class="progress-group">
    <span class="progress-text">Golongan Darah AB</span>
    <span class="float-right"><b>{{ $progres[0]->goldar_AB}}</b>/{{ $progres[0]->ALL_STOK}}</span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-success" style="width: {{ $progres[0]->goldar_AB / $progres[0]->ALL_STOK * 100 }}%"></div>
    </div>
</div>

<div class="progress-group">
    Golongan Darah O
    <span class="float-right"><b>{{ $progres[0]->goldar_O}}</b>/{{ $progres[0]->ALL_STOK}}</span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-warning" style="width: {{ $progres[0]->goldar_O / $progres[0]->ALL_STOK * 100 }}%"></div>
    </div>
</div>
