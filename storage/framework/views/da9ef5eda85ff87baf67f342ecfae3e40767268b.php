<?php echo e(Form::open(array('url'=>'opportunities','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <?php if($type == 'account'): ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('account',__('Account Name'),['class'=>'form-label'])); ?>

                <?php echo Form::select('account', $account_name, $id,array('class' => 'form-control ')); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

                <?php echo Form::select('account', $account_name, null,array('class' => 'form-control ')); ?>

            </div>
        </div>
    <?php endif; ?>
    <?php if($type == 'contact'): ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('contact',__('Contacts'),['class'=>'form-label'])); ?>

                <?php echo Form::select('contact', $contact, $id,array('class' => 'form-control ')); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('contact',__('Contacts'),['class'=>'form-label'])); ?>

                <?php echo Form::select('contact', $contact, null,array('class' => 'form-control ')); ?>

            </div>
        </div>
    <?php endif; ?>
    <?php if($type == 'campaign'): ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('campaign_id',__('Campaign'),['class'=>'form-label'])); ?>

                <?php echo Form::select('campaign_id', $campaign_id,$id,array('class' => 'form-control ')); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('campaign',__('Campaign'),['class'=>'form-label'])); ?>

                <?php echo Form::select('campaign', $campaign_id, null,array('class' => 'form-control ')); ?>

            </div>
        </div>
    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('stage',__('Opportunities Stage'),['class'=>'form-label'])); ?>

            <?php echo Form::select('stage', $opportunities_stage, null,array('class' => 'form-control ','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('amount',__('Amount'),['class'=>'form-label'])); ?>

            <?php echo Form::number('amount', null,array('class' => 'form-control ','placeholder'=>__('Enter Amount'),'required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('probability',__('Probability'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('probability',null,array('class'=>'form-control','placeholder'=>__('Enter Probability'),'required'=>'required'))); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('close_date',__('Close Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('close_date',date('Y-m-d'),array('class'=>'form-control ','placeholder'=>__('Enter Title'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_source',__('Lead Source'),['class'=>'form-label'])); ?>

            <?php echo Form::select('lead_source', $leadsource, null,array('class' => 'form-control ')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Assign User',__('Assign User'))); ?>

            <?php echo Form::select('user', $user, null,array('class' => 'form-control ')); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))); ?>

        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"
        data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH D:\Laravel Projects\addonix\resources\views/opportunities/create.blade.php ENDPATH**/ ?>