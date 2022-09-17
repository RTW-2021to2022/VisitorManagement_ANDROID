package com.example.visitmanagement;

import static android.content.ContentValues.TAG;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.Manifest;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.content.Intent;

import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class RegisterActivity extends AppCompatActivity {
    private EditText et_id, et_pw, et_pwcheck, et_name,et_phone, et_belong;
    private Button btn_register, btn_upload;
    private TextView tv_photo;
    String TAG = "RegisterActivity";

    Uri uri;//이미지

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        //값 찾아주기
        et_id=findViewById(R.id.et_id);
        et_pw=findViewById(R.id.et_pw);
        et_pwcheck=findViewById(R.id.et_pwcheck);
        et_name=findViewById(R.id.et_name);
        et_phone=findViewById(R.id.et_phone);
        et_belong=findViewById(R.id.et_belong);

        tv_photo=findViewById(R.id.tv_photo);
        btn_upload = findViewById(R.id.btn_upload);

        //업로드 버튼 클릭
        btn_upload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Intent.ACTION_PICK);
                intent.setType("image/*");
                startActivityForResult(intent, 1);
            }
        });

        //회원가입 버튼 클릭 시 수행
        btn_register= findViewById(R.id.btn_register);
        btn_register.setOnClickListener(view -> {
            //editText에 입력되어 있는 값 get
            String userID=et_id.getText().toString();
            String userPass=et_pw.getText().toString();
            String userPassCheck=et_pwcheck.getText().toString();
            String userName=et_name.getText().toString();
            int userPhone=Integer.parseInt(et_phone.getText().toString());
            String userBelong=et_belong.getText().toString();

            Intent intent=new Intent(RegisterActivity.this, Mainpage.class);
            startActivity(intent);

            Response.Listener<String> responseListener= response -> {
                try{
                    JSONObject jsonObject=new JSONObject(response);
                    boolean success=jsonObject.getBoolean("success");
                    if(success){
                        String image=jsonObject.getString("profileimage");
                        Toast.makeText(getApplicationContext(),"회원가입을 완료하였습니다.",Toast.LENGTH_SHORT).show();
//                        Intent intent=new Intent(RegisterActivity.this, LoginActivity.class);
//                        startActivity(intent);
                    }else{
                        Toast.makeText(getApplicationContext(), "회원가입에 실패하였습니다.", Toast.LENGTH_SHORT).show();
                    return;
                    }
                }catch (JSONException e){
                    e.printStackTrace();
                }
            };
            // 서버로 Volley를 이용해서 요청을 함.
            RegisterRequest registerRequest = new RegisterRequest(userID,userPass,userPassCheck,userName,userPhone,userBelong,uri, responseListener);
            RequestQueue queue = Volley.newRequestQueue(RegisterActivity.this);
            queue.add(registerRequest);
        });



    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        switch(requestCode) {
            case 1:
                if (resultCode == RESULT_OK) {
                    Uri uri = data.getData();
                  tv_photo.setText((CharSequence) uri);
                }
                break;
        }
    }
}
