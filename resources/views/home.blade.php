@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" id="app">

                <tabs v-on:tab-selected="changeTab">
                    <tab-pane label="DashBoard"></tab-pane>
                    <tab-pane label="Graph"></tab-pane>
                    <tab-pane label="OAuth2"></tab-pane>
                    <tab-pane label="Personal Access Token"></tab-pane>

                    <div v-show="tabSelect(0)">
                        <add-component :notification="openNotificationWithType" @added="dashboardAdd"></add-component>
                        <dashboard :is-init="isInitial" :datalist="componentList" @change="changeData" @remove="removeItem"></dashboard>
                    </div>

                    <div v-show="tabSelect(1)">
                        <graph :notification="openNotificationWithType" :datalist="componentList"></graph>
                    </div>

                    <div v-show="tabSelect(2)">

                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>

                    </div>
                    <div v-show="tabSelect(3)">
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </tabs>

            </div>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
@endsection
