<div id="seo-section">
    <x-input title="Meta Title" placeholder="Meta Title" name="meta_title" type='text' :value="old('meta_title',@$data->meta_title)" />
    <x-input title="Meta Keywords" placeholder="Meta,Keywords" name="meta_keywords" type='textarea' :value="old('meta_keywords',@$data->meta_keywords)" />
    <x-input title="Meta Description" placeholder="Meta Description" name="meta_descritpions" type='textarea' :value="old('meta_descritpions',@$data->meta_descritpions)" />
</div>

