<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tenant;
use App\Scopes\TenantScope;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Tenant::factory(10)->hasStores(1)->create();

        foreach (Store::withoutGlobalScope(TenantScope::class)->get() as $store) {

            $tenantAndStoreIds = ['store_id' => $store->id, 'tenant_id' => $store->tenant_id];

            Product::factory(20, $tenantAndStoreIds)->create();
        }
    }
}
