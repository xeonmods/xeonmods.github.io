<div class="card">
    <div class="card-body">
        <table class="uk-table uk-table-justify uk-table-divider purple-datatable">
            <thead>
                <?php
                    echo $this->Html->tableHeaders([
                        ['No' => ['width' => '30']],
                        'Name',
                        'Size',
                        ['Action' => ['class' => 'uk-width-small text-center']]
                    ]);
                ?>
            </thead>
            <tbody> 
                <?php
                    $i = 1;
                    foreach ($docs as $doc):
                        $filePath = $this->cell('Medias::mediaPath', [$doc->name, 'document']);
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><span uk-tooltip="<?= $doc->name ?>"><?= $doc->title ?></span></td>
                    <td><?= $this->Purple->readableFileSize($doc->size) ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon button-edit-media" data-purple-id="<?= $doc->id ?>" data-purple-by="<?= ucwords($doc->admin->display_name) ?>" data-purple-host="<?= $this->request->host() ?>" data-purple-file="<?= $filePath ?>" data-purple-created="<?= date('F d, Y H:i', strtotime($doc->created)) ?>" data-purple-title="<?= $doc->title ?>" data-purple-description="<?= $doc->description ?>" uk-tooltip="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                        <button type="button" class="btn btn-inverse-success btn-rounded btn-icon button-download-media" data-purple-url="<?= $this->Url->build('/uploads/documents/'.$doc->name, true) ?>" data-purple-name="<?= $doc->name ?>" uk-tooltip="Download">
                            <i class="mdi mdi-download"></i>
                        </button>
                        <button type="button" class="btn btn-inverse-danger btn-rounded btn-icon button-delete-media" data-purple-id="<?= $doc->id ?>" data-purple-name="<?= $doc->name ?>" uk-tooltip="Delete">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                </tr>
                <?php
                        $i++;
                    endforeach;
                    unset($i);
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.purple-datatable').DataTable();
        
        $(".button-download-media").click(function () {
            var btn  = $(this),
                url  = btn.data('purple-url'),
                name = btn.data('purple-name')
            
            var fileDownload = fileDownloader(url, name);
            return false;
        })
        
        $(".button-edit-media").click(function () {
            var id      = $(this).data('purple-id'),
                file    = $(this).data('purple-file'),
                host    = $(this).data('purple-host'),
                by      = $(this).data('purple-by'),
                created = $(this).data('purple-created'),
                desc    = $(this).data('purple-description'),
                title   = $(this).data('purple-title'),
                modal   = $("#modal-edit-media");
            modal.find("form input[name=id]").val(id);
            modal.find("form input[name=title]").val(title);
            modal.find("form textarea[name=description]").val(desc);
            modal.find("form input[name=path]").val(file);
            modal.find(".bind-created").html('Uploaded at ' + created);
            modal.find(".bind-by").html('Uploaded by ' + by);
            UIkit.modal('#modal-edit-media').show();
            
            var clipboard   = new ClipboardJS('#button-clipboard-js'),
                targetLabel = modal.find("form label[for=path]").html();

            clipboard.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);
                modal.find("form label[for=path]").html(targetLabel + ' <span class="text-primary">Copied</span>');

                e.clearSelection();
            });

            clipboard.on('error', function(e) {
                console.error('Action:', e.action);
                console.error('Trigger:', e.trigger);
                modal.find("form label[for=path]").html(targetLabel + ' <span class="text-danger">Error. Text is not copied</span>');

            });
            
            return false;
        });
        
        $(".button-delete-media").on("click", function() {
            var btn         = $(this),
                id          = btn.data('purple-id'),
                title       = btn.data('purple-name'),
                deleteModal = $("#modal-delete-media"),
                deleteForm  = deleteModal.find("form"),
                deleteID    = deleteForm.find("input[name=id]"),
                deleteTitle = deleteForm.find(".bind-title");

            deleteID.val(id);
            deleteTitle.html(title);

            UIkit.modal('#modal-delete-media').show();
            return false;
        })
    })
</script>
