<?php echo e(Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Company Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Company Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Company Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('name',null,array('class'=>'form-control','placeholder'=>__('Company Address'),'required'=>'required','rows'=>'1','cols'=>'10'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('website',__('Website'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('website',null,array('class'=>'form-control','placeholder'=>__('Enter Website'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('industry',__('Industry'),['class'=>'form-label'])); ?>

            <?php echo Form::select('industry', $industry, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Assign User',__('Assign User'),['class'=>'form-label'])); ?>

            <?php echo Form::select('user', $user, null,array('class' => 'form-control','required' => 'required')); ?>

        </div>
    </div>

    <!-- <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

            <?php echo Form::select('account', $account, null,array('class' => 'form-control')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('title',__('Title'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Title'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_address',__('Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::label('lead_city',__('City'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_city',null,array('class'=>'form-control','placeholder'=>__('City'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::label('lead_state',__('State'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_state',null,array('class'=>'form-control','placeholder'=>__('State'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_postalcode',__('Postal Code'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_postalcode',null,array('class'=>'form-control','placeholder'=>__('Postal Code'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_country',__('Country'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_country',null,array('class'=>'form-control','placeholder'=>__('Country'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <hr class="mt-2 mb-2">
        <h6><?php echo e(__('Details')); ?></h6>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

            <?php echo Form::select('status',$status, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('source',__('Source'),['class'=>'form-label'])); ?>

            <?php echo Form::select('source', $leadsource, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('opportunity_amount',__('Opportunity Amount'),['class'=>'form-label'])); ?>

            <?php echo Form::number('opportunity_amount', null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <?php if($type == 'campaign'): ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('campaign',__('Campaign'),['class'=>'form-label'])); ?>

                <?php echo Form::select('campaign', $campaign, $id,array('class' => 'form-control')); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('campaign',__('Campaign'),['class'=>'form-label'])); ?>

                <?php echo Form::select('campaign', $campaign, null,array('class' => 'form-control')); ?>

            </div>
        </div>
    <?php endif; ?>
    
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))); ?>

        </div>
    </div> -->
    
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"
        data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH D:\projects\addonix\resources\views/lead/create.blade.php ENDPATH**/ ?>