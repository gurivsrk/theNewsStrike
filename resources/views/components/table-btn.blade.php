<style>
    .action-btn{
        position: absolute;
        left: 151px;
    }
    .action-btn .btn{
        margin-right: -10px;
    }
    #selectNone{
        background: #7e7e7e;
    }
    #deleteSelected{
        background: #f44336;
    }
</style>
<div class="action-btn">
    <button class="btn btn-sm btn-info" id="selectAll">Select all</button>
    <button class="btn btn-sm btn-info" id="selectNone">Select none</button>
    <button class="btn btn-sm btn-info" id="deleteSelected">Delete selected</button>
</div>

<script>
    document.getElementById('selectAll').addEventListener('click',()=>{
        table.rows().select();
    })
    document.getElementById('selectNone').addEventListener('click',()=>{
        table.rows().deselect();
    })
    document.getElementById('deleteSelected').addEventListener('click',()=>{
        table.rows().select();
    })
</script>
