<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        $admin = Setting::create([
            'logo' => 'storage/uploads/img.png',
            'favicon' => 'storage/uploads/img.png',
            'title' => 'اسواق الامتياز',
            'footer' => 'اسواق الامتياز',
            'facebook' => 'https://web.facebook.com/?_rdc=1&_rdr',
            'twitter' => 'https://x.com/?lang=ar&mx=2',
            'youtube' => 'https://www.youtube.com/watch?v=xXhid7s6Zu8',
            'instagram' => 'https://www.instagram.com/',
            'location' => 'المنوفيه',
            'location_url' => 'https://maps.app.goo.gl/xbmRs5NpToaCs5ST9',
            'email' => 'amomatter48@gmail.com',
            'phone' => '01024791856',
            'working_hours' => '24',
            'terms' => '<p><strong>الشروط والأحكام</strong></p><p>تحدد هذه الشروط والأحكام القواعد التي يجب اتباعها عند استخدام موقعنا الإلكتروني وخدماتنا. باستخدامك لموقعنا، فإنك توافق على الالتزام بهذه الشروط.</p><p><strong>1. قبول الشروط:</strong></p><p>باستخدامك للموقع، فإنك توافق على هذه الشروط والأحكام بالكامل. إذا كنت لا توافق على أي جزء منها، يرجى عدم استخدام موقعنا.</p><p><strong>2. التعديلات على الشروط والأحكام:</strong></p><p>نحتفظ بالحق في تعديل هذه الشروط والأحكام في أي وقت. سيتم نشر التعديلات على هذه الصفحة، ويُعتبر استمرارك في استخدام الموقع بعد أي تعديل بمثابة قبولك للشروط المعدلة.</p><p><strong>3. الخدمات:</strong></p><p>نوفر مجموعة من المنتجات والخدمات التي قد تختلف من وقت لآخر. نحتفظ بالحق في تعديل أو إيقاف الخدمات في أي وقت دون إشعار مسبق.</p><p><strong>4. الطلبات والدفع:</strong></p><p>جميع الطلبات تعتمد على توافر المنتجات وتأكيد الدفع.</p><p>نحتفظ بالحق في رفض أو إلغاء أي طلب لأي سبب، بما في ذلك الأخطاء في الأسعار أو المعلومات غير الصحيحة.</p><p><strong>5. سياسة الإرجاع والاستبدال:</strong></p><p>يمكنك طلب إرجاع أو استبدال المنتجات في غضون 14 يومًا من استلامها، بشرط أن تكون في حالتها الأصلية وغير مستخدمة.</p><p>لن يتم رد رسوم الشحن إلا إذا كان الخطأ من جانبنا.</p><p><strong>6. الملكية الفكرية:</strong></p><p>جميع المحتويات على الموقع، بما في ذلك النصوص، والصور، والرسوم البيانية، والشعارات، محمية بموجب حقوق الطبع والنشر والعلامات التجارية. يحظر إعادة إنتاج أو توزيع أي محتوى دون إذن كتابي صريح من مالكي الموقع.</p><p><strong>7. حدود المسؤولية:</strong></p><p>نحن غير مسؤولين عن أي أضرار ناتجة عن استخدامك للموقع أو عدم القدرة على استخدامه.</p><p>لا نتحمل المسؤولية عن أي خسائر مباشرة أو غير مباشرة ناتجة عن استخدام منتجاتنا أو خدماتنا.</p><p><strong>8. القانون الواجب التطبيق:</strong></p><p>تخضع هذه الشروط والأحكام للقوانين المعمول بها في [الدولة]، وأي نزاعات تنشأ عنها يجب أن تكون خاضعة لاختصاص المحاكم في [الدولة].</p><p><strong>9. الاتصال بنا:</strong></p><p>إذا كان لديك أي استفسارات حول هذه الشروط والأحكام، يمكنك التواصل معنا عبر البريد الإلكتروني أو الهاتف الموضحين في صفحة "اتصل بنا".</p>',
            'privacy' => ' <p>إحنا بنحتفظ بحقنا في إنهاء أو تعليق حسابك في أي وقت لمرحبًا بكم في متجرنا الإلكتروني. نحن نقدر خصوصيتك ونلتزم بحماية بياناتك الشخصية. تنطبق سياسة الخصوصية هذه على جميع البيانات الشخصية التي نجمعها من خلال موقعنا الإلكتروني، بما في ذلك البيانات التي تقدمها عند التسجيل، والشراء، واستخدام خدماتنا.</p><p><strong>1. جمع البيانات الشخصية:</strong></p><p>نقوم بجمع البيانات الشخصية مثل الاسم، وعنوان البريد الإلكتروني، والعنوان البريدي، ورقم الهاتف، وتفاصيل الدفع عندما تقوم بإجراء طلب أو التسجيل على موقعنا.</p><p>نستخدم تقنيات مختلفة مثل ملفات تعريف الارتباط لجمع معلومات عن زياراتك لموقعنا واستخدامك له.</p><p><strong>2. استخدام البيانات الشخصية:</strong></p><p>نستخدم بياناتك الشخصية لتقديم الخدمات التي طلبتها، مثل معالجة الطلبات والشحن.</p><p>قد نستخدم بياناتك للتواصل معك بخصوص تحديثات المنتجات، والعروض الترويجية، والخدمات الجديدة إذا وافقت على ذلك.</p><p>نستخدم البيانات لتحسين تجربة المستخدم وتخصيص محتوى الموقع وفقًا لاحتياجاتك.</p><p><strong>3. مشاركة البيانات الشخصية:</strong></p><p>نحن لا نبيع أو نؤجر بياناتك الشخصية لأطراف ثالثة.</p><p>قد نشارك بياناتك مع مزودي الخدمات الذين يساعدوننا في تشغيل موقعنا، مثل شركات الشحن ومقدمي خدمات الدفع، وذلك فقط للغرض المقصود.</p><p>قد نكشف عن بياناتك إذا كان ذلك مطلوبًا بموجب القانون أو لحماية حقوقنا.</p><p><strong>4. الأمان:</strong></p><p>نستخدم إجراءات أمنية متقدمة لحماية بياناتك من الوصول غير المصرح به والتعديلات غير المصرح بها.</p><p><strong>5. حقوقك:</strong></p><p>لديك الحق في الوصول إلى بياناتك الشخصية وتصحيحها وحذفها.</p><p>يمكنك سحب موافقتك على معالجة بياناتك الشخصية في أي وقت.</p><p><strong>6. التغييرات في سياسة الخصوصية:</strong></p><p>نحتفظ بالحق في تعديل سياسة الخصوصية في أي وقت. سيتم نشر أي تغييرات هنا، ونوصيك بمراجعة هذه الصفحة بانتظام.و انتهكت الشروط والأحكام أو لو شفنا إن فيه سلوك غير لائق.</p><p><strong>القوانين المطبقة</strong><br>الشروط والأحكام دي خاضعة للقوانين المحلية، وأي نزاع هيتم حله في المحاكم المحلية.</p>',
            'faqs' => '<p><strong>الأحكام</strong></p><p>ترتبط هذه الأحكام باستخدامك لموقعنا الإلكتروني والخدمات التي نقدمها. يرجى قراءة الأحكام بعناية لضمان معرفتك الكاملة بحقوقك وواجباتك عند استخدام الموقع.</p><p><strong>1. استخدام الموقع:</strong></p><p>يتعين على المستخدمين استخدام الموقع للأغراض القانونية فقط، والامتناع عن استخدامه في أي نشاط غير قانوني أو غير مصرح به.</p><p><strong>2. الشروط الأساسية:</strong></p><p>بمجرد استخدامك للموقع، فإنك توافق على جميع الأحكام والشروط المنصوص عليها. إذا كنت لا توافق على أي من هذه الأحكام، فيُرجى عدم استخدام الموقع.</p><p><strong>3. التسجيل والحساب:</strong></p><p>قد يُطلب منك إنشاء حساب لاستخدام بعض خدماتنا. يجب أن تكون جميع المعلومات المقدمة دقيقة وحديثة.</p><p>المستخدم مسؤول عن الحفاظ على سرية معلومات الحساب وكلمة المرور.</p><p><strong>4. الدقة في المحتوى والأسعار:</strong></p><p>نبذل قصارى جهدنا لضمان دقة جميع المعلومات والأسعار المعروضة على الموقع. ومع ذلك، قد تحدث أخطاء، ونحتفظ بالحق في تصحيح أي خطأ في المعلومات أو الأسعار دون إشعار مسبق.</p><p><strong>5. الشحن والتسليم:</strong></p><p>يتم تحديد تفاصيل الشحن والتسليم في صفحة الشحن والتسليم بالموقع، والتي يُنصح المستخدمون بمراجعتها قبل إجراء أي طلب.</p><p><strong>6. سياسة الإرجاع والاستبدال:</strong></p><p>تفاصيل الإرجاع والاستبدال مذكورة في صفحة "سياسة الإرجاع والاستبدال" على الموقع، ويجب على المستخدمين مراجعتها قبل تقديم الطلبات.</p><p><strong>7. الملكية الفكرية:</strong></p><p>جميع المحتويات والمواد المعروضة على الموقع، بما في ذلك النصوص والصور والرسوم البيانية، محمية بموجب حقوق الطبع والنشر والعلامات التجارية. يُمنع نسخ أو استخدام أي من محتويات الموقع دون إذن كتابي مسبق.</p><p><strong>8. التعليقات والمراجعات:</strong></p><p>يُسمح للمستخدمين بترك تعليقات ومراجعات على المنتجات والخدمات، ولكن يُحظر نشر محتوى غير لائق أو مسيء أو غير قانوني.</p><p><strong>9. التغييرات على الأحكام:</strong></p><p>نحتفظ بالحق في تعديل أو تحديث هذه الأحكام في أي وقت. يُنصح المستخدمون بمراجعة هذه الصفحة بانتظام للبقاء على علم بأي تغييرات.</p><p><strong>10. القانون الواجب التطبيق:</strong></p><p>تخضع هذه الأحكام للقوانين المعمول بها في [الدولة]، وأي نزاعات تنشأ عنها يجب أن تكون خاضعة لاختصاص المحاكم في [الدولة].</p>',
            'price_of_point' => '1',

        ]);

        // Ensure all permissions are created

    }
}
