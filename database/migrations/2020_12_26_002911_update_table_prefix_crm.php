<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablePrefixCrm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('contacts', 'crm_contacts');
        Schema::rename('contracts', 'crm_contracts');
        Schema::rename('customers', 'crm_customers');
        Schema::rename('customfields', 'crm_customfields');
        Schema::rename('events', 'crm_events');
        Schema::rename('invoices', 'crm_invoices');
        Schema::rename('opportunitys', 'crm_opportunitys');
        Schema::rename('products', 'crm_products');
        Schema::rename('receipts', 'crm_receipts');
        Schema::rename('shares', 'crm_shares');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('crm_contacts', 'contacts');
        Schema::rename('crm_contracts', 'contracts');
        Schema::rename('crm_customers', 'customers');
        Schema::rename('crm_customfields', 'customfields');
        Schema::rename('crm_events', 'events');
        Schema::rename('crm_invoices', 'invoices');
        Schema::rename('crm_opportunitys', 'opportunitys');
        Schema::rename('crm_products', 'products');
        Schema::rename('crm_receipts', 'receipts');
        Schema::rename('crm_shares', 'shares');
    }
}
