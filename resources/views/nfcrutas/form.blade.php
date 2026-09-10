<div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo', isset($nfcruta) ? $nfcruta->titulo : '') }}" required>
    <small class="form-text text-muted">El ID público de 20 caracteres se genera automáticamente al crear la ruta.</small>
</div>
<div class="form-group">
    <label for="url">URL de destino</label>
    <textarea id="url" name="url" class="form-control" rows="3" required>{{ old('url', isset($nfcruta) ? $nfcruta->url : '') }}</textarea>
</div>
<div class="form-group">
    <div class="form-check">
        <input type="checkbox" id="activo" name="activo" class="form-check-input" value="1" {{ old('activo', isset($nfcruta) ? (int) $nfcruta->activo : 1) ? 'checked' : '' }}>
        <label class="form-check-label" for="activo">Activo</label>
    </div>
</div>
