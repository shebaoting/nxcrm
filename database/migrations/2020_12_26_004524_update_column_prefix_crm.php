<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnPrefixCrm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_contacts', function (Blueprint $table) {
            $table->renameColumn('customer_id', 'crm_customer_id');
        });
        Schema::table('crm_contracts', function (Blueprint $table) {
            $table->renameColumn('customer_id', 'crm_customer_id');
        });
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->renameColumn('admin_users_id', 'admin_user_id');
        });
        Schema::table('crm_events', function (Blueprint $table) {
            $table->renameColumn('customer_id', 'crm_customer_id');
            $table->renameColumn('contact_id', 'crm_contact_id');
            $table->renameColumn('contract_id', 'crm_contract_id');
            $table->renameColumn('opportunity_id', 'crm_opportunity_id');
        });
        Schema::table('crm_invoices', function (Blueprint $table) {
            $table->renameColumn('contract_id', 'crm_contract_id');
            $table->renameColumn('receipt_id', 'crm_receipt_id');
        });
        Schema::table('crm_opportunitys', function (Blueprint $table) {
            $table->renameColumn('customer_id', 'crm_customer_id');
        });
        Schema::table('attachments', function (Blueprint $table) {
            $table->renameColumn('customer_id', 'crm_customer_id');
            $table->renameColumn('contract_id', 'crm_contract_id');
            $table->renameColumn('opportunity_id', 'crm_opportunity_id');
            $table->renameColumn('invoice_id', 'crm_invoice_id');
        });
        Schema::table('crm_receipts', function (Blueprint $table) {
            $table->renameColumn('contract_id', 'crm_contract_id');
        });
        Schema::table('crm_shares', function (Blueprint $table) {
            $table->renameColumn('customer_id', 'crm_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_contacts', function (Blueprint $table) {
            $table->renameColumn('crm_customer_id', 'customer_id');
        });
        Schema::table('crm_contracts', function (Blueprint $table) {
            $table->renameColumn('crm_customer_id', 'customer_id');
        });
        Schema::table('crm_customers', function (Blueprint $table) {
            $table->renameColumn('admin_user_id', 'admin_users_id');
        });
        Schema::table('crm_events', function (Blueprint $table) {
            $table->renameColumn('crm_customer_id', 'customer_id');
            $table->renameColumn('crm_contact_id', 'contact_id');
            $table->renameColumn('crm_contract_id', 'contract_id');
            $table->renameColumn('crm_opportunity_id', 'opportunity_id');
        });
        Schema::table('crm_invoices', function (Blueprint $table) {
            $table->renameColumn('crm_contract_id', 'contract_id');
            $table->renameColumn('crm_receipt_id', 'receipt_id');
        });
        Schema::table('crm_opportunitys', function (Blueprint $table) {
            $table->renameColumn('crm_customer_id', 'customer_id');
        });
        Schema::table('attachments', function (Blueprint $table) {
            $table->renameColumn('crm_customer_id', 'customer_id');
            $table->renameColumn('crm_contract_id', 'contract_id');
            $table->renameColumn('crm_opportunity_id', 'opportunity_id');
            $table->renameColumn('crm_invoice_id', 'invoice_id');
        });
        Schema::table('crm_receipts', function (Blueprint $table) {
            $table->renameColumn('crm_contract_id', 'contract_id');
        });
        Schema::table('crm_shares', function (Blueprint $table) {
            $table->renameColumn('crm_customer_id', 'customer_id');
        });
    }
}
