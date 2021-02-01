<?php

    namespace BrokenTitan\PowerBI\View\Components;

    use Illuminate\View\Component;

    class Report extends Component {
        public string $reportId;
        public string $groupId;

        public function __construct(string $reportId, string $groupId) {
            $this->reportId = $reportId;
            $this->groupId = $groupId;
        }

        public function render() {
            return view("powerbi::report");
        }
    }
