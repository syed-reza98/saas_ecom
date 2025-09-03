<?php
    use Filament\Support\Facades\FilamentView;
?>

<!--[if BLOCK]><![endif]--><?php if($this->hasUnsavedDataChangesAlert() && (! FilamentView::hasSpaMode())): ?>
        <?php
        $__scriptKey = '2235396723-0';
        ob_start();
    ?>
        <script>
            window.addEventListener('beforeunload', (event) => {
                if (
                    window.jsMd5(
                        JSON.stringify($wire.data).replace(/\\/g, ''),
                    ) === $wire.savedDataHash ||
                    $wire?.__instance?.effects?.redirect
                ) {
                    return
                }

                event.preventDefault()
                event.returnValue = true
            })
        </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
<?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
<?php /**PATH G:\2_16_2024\Ecom\backend\vendor\filament\filament\src\/../resources/views/components/page/unsaved-data-changes-alert.blade.php ENDPATH**/ ?>