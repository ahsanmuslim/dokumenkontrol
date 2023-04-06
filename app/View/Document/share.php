<label for="akses">Share to Divisi</label>
<input type="hidden" value="<?= $data['no_surat'] ?>" name="nosurat" class="form-control">
<select name="akses[]" id="sharedoc" class="form-control" multiple="multiple" required>
    <?php 
        foreach($data['divisi'] as $div): 
            $akses = '';
            foreach ($data['akses'] as $ak): ?>
                <?php
                if($div['kd_divisi'] == $ak['kd_divisi']){
                    $akses = 'selected';
                    break;
                }
                ?>
            <?php endforeach; ?>
            <option value="<?= $div['kd_divisi'] ?>" <?= $akses ?>><?= $div['nama_divisi'] ?></option>
    <?php endforeach; ?>
</select>

<script>
    $(document).ready(function() {
        $('#sharedoc').select2({
            width: "100%"
        });
    });
</script>