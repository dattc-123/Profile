@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23374151" fill-opacity="0.05"%3E%3Cpath d="m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

    <div class="container mx-auto px-6 py-16 relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-gray-600 to-gray-800 rounded-2xl mb-6 shadow-2xl">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h1 class="text-6xl font-bold bg-gradient-to-r from-gray-800 via-gray-700 to-gray-900 bg-clip-text text-transparent mb-4">
                Pricing Plans
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Chọn gói dịch vụ phù hợp với nhu cầu của bạn. Tất cả gói đều bao gồm hỗ trợ 24/7 và cập nhật miễn phí.
            </p>
        </div>

        <!-- Billing Toggle -->
        <div class="flex justify-center mb-12">
            <div class="relative bg-white/80 backdrop-blur-xl border border-gray-300 rounded-2xl p-2 shadow-2xl">
                <form id="cycleForm" method="get" action="">
                    <input type="hidden" name="cycle" id="cycleInput" value="{{ $cycle ?? 'monthly' }}">
                    <div class="flex relative">
                        <div class="absolute inset-y-1 transition-all duration-500 ease-out bg-gradient-to-r from-gray-600 to-gray-800 rounded-xl shadow-lg {{ ($cycle ?? 'monthly') == 'monthly' ? 'left-1 w-[calc(50%-0.25rem)]' : 'left-1/2 w-[calc(50%-0.25rem)]' }}"></div>
                        <button type="button" id="monthly" class="relative z-10 px-8 py-3 text-sm font-semibold rounded-xl transition-all duration-300 {{ ($cycle ?? 'monthly') == 'monthly' ? 'text-white' : 'text-gray-600 hover:text-gray-800' }}">
                            Hàng tháng
                        </button>
                        <button type="button" id="yearly" class="relative z-10 px-8 py-3 text-sm font-semibold rounded-xl transition-all duration-300 {{ ($cycle ?? 'monthly') == 'yearly' ? 'text-white' : 'text-gray-600 hover:text-gray-800' }}">
                            Hàng năm
                            <span class="ml-2 px-2 py-1 text-xs bg-green-500/20 text-green-600 rounded-full">-20%</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Plans Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            @forelse($subscriptionPlans as $index => $plan)
            <div class="group relative">
                <!-- Popular badge -->
                @if($index == 1)
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 z-20">
                    <div class="bg-gradient-to-r from-gray-600 to-gray-800 text-white px-6 py-2 rounded-full text-sm font-semibold shadow-lg">
                        Phổ biến nhất
                    </div>
                </div>
                @endif

                <div class="relative h-full bg-white/60 backdrop-blur-xl border border-gray-300 rounded-3xl overflow-hidden shadow-2xl transition-all duration-500 group-hover:scale-105 group-hover:shadow-gray-500/25 group-hover:border-gray-500/50">
                    <!-- Gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-500/10 via-transparent to-gray-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative p-8">
                        <!-- Plan Header -->
                        <div class="text-center mb-8">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-gray-500/20 to-gray-600/20 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                <div class="w-6 h-6 bg-gradient-to-r from-gray-600 to-gray-800 rounded-lg"></div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $plan->name }}</h3>
                            <div class="flex items-baseline justify-center">
                                <span class="text-5xl font-bold bg-gradient-to-r from-gray-800 to-gray-700 bg-clip-text text-transparent">
                                    {{ number_format($plan->price) }}
                                </span>
                                <span class="text-gray-600 ml-2">đ/{{ $plan->billing_cycle }}</span>
                            </div>
                        </div>

                        <!-- Features List -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Mã gói:</strong> {{ $plan->code }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Thời hạn:</strong> {{ $plan->duration_in_days }} ngày</span>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <button onclick="openModal('{{ $plan->id }}')"
                                class="w-full bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-gray-500/25 focus:outline-none focus:ring-4 focus:ring-gray-500/50">
                            <span class="flex items-center justify-center">
                                Xem chi tiết
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <!-- Hidden plan details -->
                    <div class="hidden plan-detail-html" id="plan-detail-{{ $plan->id }}">
                        <div class="space-y-4">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">ID:</span>
                                <span class="text-gray-900">{{ $plan->id }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Tên gói:</span>
                                <span class="text-gray-900 font-semibold">{{ $plan->name }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Mã gói:</span>
                                <span class="text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">{{ $plan->code }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Giá:</span>
                                <span class="text-gray-900 font-bold text-lg">{{ number_format($plan->price) }}đ</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Chu kỳ thanh toán:</span>
                                <span class="text-gray-900">{{ $plan->billing_cycle }}</span>
                            </div>
                            <div class="flex justify-between py-3">
                                <span class="font-medium text-gray-600">Thời hạn sử dụng:</span>
                                <span class="text-gray-900">{{ $plan->duration_in_days }} ngày</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-400/50 rounded-2xl mb-4">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Không có gói nào</h3>
                <p class="text-gray-600">Hiện tại chưa có gói dịch vụ nào phù hợp.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div id="modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex justify-center items-center opacity-0 invisible transition-all duration-300 ease-out z-50">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl mx-4 transform scale-95 transition-all duration-300 ease-out" id="modal-content">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-800 rounded-t-3xl p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Chi tiết gói đăng ký</h3>
                </div>
                <button onclick="closeModal()" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition-colors duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-8">
            <div id="modal-description" class="text-gray-700"></div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 rounded-b-3xl p-6 flex justify-end space-x-3">
            <button onclick="closeModal()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-colors duration-200">
                Đóng
            </button>
            <button class="px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105">
                Chọn gói này
            </button>
        </div>
    </div>
</div>

<script>
    // Enhanced billing cycle toggle
    document.getElementById('monthly').addEventListener('click', function() {
        if (document.getElementById('cycleInput').value !== 'monthly') {
            document.getElementById('cycleInput').value = 'monthly';
            document.getElementById('cycleForm').submit();
        }
    });

    document.getElementById('yearly').addEventListener('click', function() {
        if (document.getElementById('cycleInput').value !== 'yearly') {
            document.getElementById('cycleInput').value = 'yearly';
            document.getElementById('cycleForm').submit();
        }
    });
    // Enhanced modal functionality
    function openModal(planId) {
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modal-content');
        const detail = document.getElementById('plan-detail-' + planId);

        document.getElementById('modal-description').innerHTML = detail ? detail.innerHTML :
            '<div class="text-center py-8"><p class="text-gray-500">Không tìm thấy thông tin chi tiết.</p></div>';

        modal.classList.remove('invisible', 'opacity-0');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modal-content');

        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        modal.classList.add('opacity-0');

        setTimeout(() => {
            modal.classList.add('invisible');
            document.body.style.overflow = 'auto';
        }, 300);
    }
    // Close modal on backdrop click
    document.getElementById('modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';
    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = `${entry.target.dataset.delay || 0}ms`;
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);
    // Observe all plan cards
    document.querySelectorAll('.group').forEach((card, index) => {
        card.dataset.delay = index * 100;
        observer.observe(card);
    });
</script>

<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out forwards;
    }
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #6b7280, #4b5563);
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #4b5563, #374151);
    }
    /* Smooth transitions */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }
</style>
@endsection