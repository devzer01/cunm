{include file="headerv2.tpl"}
<div class="container">
    <div class="page-header">
        <h1>Credit Union Market Profiles</h1>
        <p class="subtitle">Federation: {$federation_name}</p>
    </div>

    <div class="action-bar">
        <div class="profile-count">
            <strong>Total Profiles:</strong> {$total_profiles}
        </div>
        <div class="actions">
            <a href="/federation/cu-market-profile/create/{$federation_id}" class="btn btn-primary">
                <i class="icon-plus"></i> Create New Profile
            </a>
            <a href="/federation/dashboard" class="btn btn-secondary">
                <i class="icon-back"></i> Back to Dashboard
            </a>
        </div>
    </div>

    {if $profiles && count($profiles) > 0}
        <div class="table-responsive">
            <table class="profile-list-table">
                <thead>
                <tr>
                    <th>Profile ID</th>
                    <th>Organization Name</th>
                    <th>Federation Name</th>
                    <th>Local Currency</th>
                    <th>Population (2024)</th>
                    <th>Member CUs</th>
                    <th>Individual Members</th>
                    <th>Contact</th>
                    <th>Submission Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$profiles item=profile}
                    <tr>
                        <td class="profile-id">{$profile.profile_id}</td>
                        <td class="org-name">
                            <strong>{$profile.organization_name|default:'-'}</strong>
                        </td>
                        <td>{$profile.fed_name|default:'-'}</td>
                        <td>{$profile.local_currency|default:'-'}</td>
                        <td class="text-right">{$profile.population_2024|number_format|default:'-'}</td>
                        <td class="text-right">{$profile.total_member_cus|number_format|default:'-'}</td>
                        <td class="text-right">{$profile.ind_member_total|number_format|default:'-'}</td>
                        <td>
                            <div class="contact-info">
                                {if $profile.email}
                                    <div><i class="icon-email"></i> {$profile.email}</div>
                                {/if}
                                {if $profile.telephone}
                                    <div><i class="icon-phone"></i> {$profile.telephone}</div>
                                {/if}
                            </div>
                        </td>
                        <td class="text-center">
                            {if $profile.submission_date}
                                {$profile.submission_date|date_format:"%Y-%m-%d"}
                            {else}
                                <span class="badge badge-warning">Draft</span>
                            {/if}
                        </td>
                        <td class="actions-cell">
                            <div class="btn-group">
                                <a href="/federation/cu-market-profile/view/{$profile.profile_id}"
                                   class="btn btn-sm btn-info"
                                   title="View Profile">
                                    <i class="icon-eye"></i> View
                                </a>
                                <a href="/federation/cu-market-profile/edit/{$profile.profile_id}"
                                   class="btn btn-sm btn-warning"
                                   title="Edit Profile">
                                    <i class="icon-edit"></i> Edit
                                </a>
                                <a href="/federation/cu-market-profile/delete/{$profile.profile_id}"
                                   class="btn btn-sm btn-danger"
                                   title="Delete Profile"
                                   onclick="return confirm('Are you sure you want to delete this profile?');">
                                    <i class="icon-trash"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    {else}
        <div class="no-profiles">
            <div class="empty-state">
                <i class="icon-folder-open"></i>
                <h3>No Profiles Found</h3>
                <p>There are no market profiles for this federation yet.</p>
                <a href="/federation/cu-market-profile/create/{$federation_id}" class="btn btn-primary btn-lg">
                    <i class="icon-plus"></i> Create First Profile
                </a>
            </div>
        </div>
    {/if}
</div>

<style>
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 {
        margin: 0 0 10px 0;
        color: #2c3e50;
    }

    .page-header .subtitle {
        color: #7f8c8d;
        font-size: 16px;
        margin: 0;
    }

    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    .profile-count {
        font-size: 16px;
        color: #2c3e50;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-secondary {
        background-color: #95a5a6;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-warning {
        background-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }

    .btn-lg {
        padding: 15px 30px;
        font-size: 18px;
    }

    .table-responsive {
        overflow-x: auto;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-radius: 5px;
    }

    .profile-list-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    .profile-list-table thead {
        background-color: #3498db;
        color: white;
    }

    .profile-list-table th {
        padding: 15px;
        text-align: left;
        font-weight: bold;
        border-bottom: 2px solid #2980b9;
    }

    .profile-list-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ecf0f1;
    }

    .profile-list-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .profile-list-table tbody tr:last-child td {
        border-bottom: none;
    }

    .profile-id {
        font-family: monospace;
        color: #7f8c8d;
        font-size: 12px;
    }

    .org-name strong {
        color: #2c3e50;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .contact-info {
        font-size: 12px;
        color: #7f8c8d;
    }

    .contact-info div {
        margin: 2px 0;
    }

    .contact-info i {
        margin-right: 5px;
    }

    .badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 11px;
        font-weight: bold;
    }

    .badge-warning {
        background-color: #f39c12;
        color: white;
    }

    .actions-cell {
        white-space: nowrap;
    }

    .btn-group {
        display: flex;
        gap: 5px;
    }

    .no-profiles {
        padding: 60px 20px;
    }

    .empty-state {
        text-align: center;
        max-width: 500px;
        margin: 0 auto;
    }

    .empty-state i {
        font-size: 80px;
        color: #bdc3c7;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #7f8c8d;
        margin-bottom: 30px;
        font-size: 16px;
    }

    /* Icon placeholders (replace with your icon system) */
    .icon-plus::before { content: "+ "; }
    .icon-back::before { content: "← "; }
    .icon-eye::before { content: "👁 "; }
    .icon-edit::before { content: "✏ "; }
    .icon-trash::before { content: "🗑 "; }
    .icon-email::before { content: "✉ "; }
    .icon-phone::before { content: "📞 "; }
    .icon-folder-open::before { content: "📂"; }

    /* Responsive design */
    @media (max-width: 1200px) {
        .profile-list-table {
            font-size: 14px;
        }

        .profile-list-table th,
        .profile-list-table td {
            padding: 10px;
        }
    }

    @media (max-width: 768px) {
        .action-bar {
            flex-direction: column;
            gap: 15px;
        }

        .actions {
            width: 100%;
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }

        .table-responsive {
            font-size: 12px;
        }

        .btn-group {
            flex-direction: column;
        }
    }
</style>

{include file="footerv2.tpl"}